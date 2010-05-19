<?php

class opMTViewerImportDiaryTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace = 'opMTViewer';
    $this->name = 'import-diary';
    $this->briefDescription = 'Import diaries from a Movable Type (MT) format file';

    $this->addArguments(array(
      new sfCommandArgument('filename', sfCommandArgument::OPTIONAL | sfCommandArgument::IS_ARRAY),
    ));
  }

  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);

    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
    $conn->beginTransaction();
    try
    {
      foreach ($arguments['filename'] as $filename)
      {
        $this->logSection('import', 'filename: '.$filename);

        if ($fh = fopen($filename, 'r'))
        {
          $op2MemberId = $this->getMemberIdFromFileName($filename);
          $this->parse($fh, $conn, null, $op2MemberId);
          fclose($fh);
        }
      }

      $jobs = Doctrine::getTable('ImportJob')->getDiaryJobs();
      foreach ($jobs as $job)
      {
        $file = $job->File;
        $member = $job->Member;

        $this->logSection('import', 'started importing diaries of '.$member->name);
        $this->logSection('import', 'filename: '.$file->name);

        $op2MemberId = $this->getMemberIdFromFileName($file->original_filename);

        try
        {
          $this->parse($file, $conn, $member, $op2MemberId);
        }
        catch (Exception $e)
        {
        }

        $job->delete();
      }

      $conn->commit();
    }
    catch (Exception $e)
    {
      $conn->rollBack();
      throw $e;
    }
  }

  protected function getMemberIdFromFileName($filename)
  {
    if (preg_match('/^.+_d_(\d+)_\d+\.txt$/', $filename, $regs))
    {
      return $regs[1];
    }
    else
    {
      return null;
    }
  }

  protected function parse($file, $conn, Member $member = null, $op2MemberId = null)
  {
    $parser = new opMTFormatParser($file);
    foreach ($parser as $entry)
    {
      $this->logSection('import', 'importing '.$entry['TITLE']);

      $diary = new Op2Diary();
      $diary->setFromArray($entry);

      if ($diary->getTable()->findSameAs($diary))
      {
        $this->logSection('import', 'the diary was already imported, skipping.');
        continue;
      }

      if (!is_null($member))
      {
        $diary->Op2Member->Member = $member;
      }
      $diary->Op2Member->number = $op2MemberId;

      if ($entry['TAGS'])
      {
        foreach (explode(',', $entry['TAGS']) as $category)
        {
          $cat = new Op2DiaryCategory();
          $cat->name = $category;
          $cat->Op2Member = $diary->Op2Member;

          $diary->Op2DiaryCategory[] = $cat;
        }
      }
      $diary->save($conn);

      if ($entry['COMMENT'])
      {
        $num = 1;
        foreach ($entry['COMMENT'] as $c)
        {
          $comment = new Op2DiaryComment();
          $comment->setFromArray($c);
          $comment->number = $num++;
          $comment->Op2Diary = $diary;

          $comment->save($conn);
        }
      }
    }
  }
}

