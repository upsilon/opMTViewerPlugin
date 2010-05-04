<?php

class opMTViewerImportDiaryTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace = 'opMTViewer';
    $this->name = 'import-diary';
    $this->briefDescription = 'Import diaries from a Movable Type (MT) format file';

    $this->addArguments(array(
      new sfCommandArgument('filename', sfCommandArgument::REQUIRED, 'filename'),
    ));
  }

  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);

    $fh = fopen($arguments['filename'], 'r');

    if (!$fh)
    {
      return;
    }

    $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
    $conn->beginTransaction();
    try
    {
      $parser = new opMTFormatParser($fh);
      foreach ($parser as $entry)
      {
        $this->logSection('import', 'importing '.$entry['TITLE']);

        $diary = new Op2Diary();
        $diary->setFromArray($entry);

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

      $conn->commit();
    }
    catch (Exception $e)
    {
      $conn->rollBack();
      throw $e;
    }

    fclose($fh);
  }
}

