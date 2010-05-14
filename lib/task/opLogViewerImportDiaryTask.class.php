<?php

class opMTViewerImportDiaryTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace = 'opMTViewer';
    $this->name = 'import-diary';
    $this->briefDescription = 'Import diaries from a Movable Type (MT) format file';

    $this->addOptions(array(
      new sfCommandOption('filename', null, sfCommandOption::PARAMETER_REQUIRED),
    ));
  }

  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);

    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
    $conn->beginTransaction();
    try
    {
      if (isset($options['filename']))
      {
        if ($fh = fopen($options['filename'], 'r'))
        {
          $this->parse($fh, $conn);
          fclose($fh);
        }
      }

      $conn->commit();
    }
    catch (Exception $e)
    {
      $conn->rollBack();
      throw $e;
    }
  }

  protected function parse($file, $conn, Member $member = null)
  {
    $parser = new opMTFormatParser($file);
    foreach ($parser as $entry)
    {
      $this->logSection('import', 'importing '.$entry['TITLE']);

      $diary = new Op2Diary();
      $diary->setFromArray($entry);

      if (!is_null($member))
      {
        $diary->Op2Member->Member = $member;
      }

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

