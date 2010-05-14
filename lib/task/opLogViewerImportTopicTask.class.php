<?php

class opMTViewerImportTopicTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->namespace = 'opMTViewer';
    $this->name = 'import-topic';
    $this->briefDescription = 'Import topics/events from a Movable Type (MT) format file';

    $this->addArguments(array(
      new sfCommandArgument('filename', sfCommandArgument::REQUIRED, 'filename'),
    ));

    $this->addOptions(array(
      new sfCommandOption('communityName', null, sfCommandOption::PARAMETER_REQUIRED, 'Community name'),
      new sfCommandOption('communityId', null, sfCommandOption::PARAMETER_REQUIRED, 'Community id'),
    ));
  }

  protected function execute($arguments = array(), $options = array())
  {
    if (!isset($options['communityName']) && !isset($options['communityId']))
    {
      throw new sfCommandArgumentsException('communityName or communityId is required.');
    }

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
      if (isset($options['communityId']))
      {
        $community = Doctrine::getTable('Op2Community')->findOneByCommunityId($options['communityId']);
        if (!$community)
        {
          throw new sfCommandException('The Community Id "'.$options['communityId'].'" not exists.');
        }
      }
      elseif (isset($options['communityName']))
      {
        $community = new Op2Community();
        $community->name = $options['communityName'];
        $community->save();
      }

      $this->parse($fh, $conn, $community);

      $conn->commit();
    }
    catch (Exception $e)
    {
      $conn->rollBack();
      throw $e;
    }

    fclose($fh);
  }

  protected function parse($file, $conn, $op2Community)
  {
    $parser = new opMTFormatParser($file);
    foreach ($parser as $entry)
    {
      $this->logSection('import', 'importing '.$entry['TITLE']);

      $isEvent = $this->isEvent($entry);

      $topic = $isEvent ? new Op2CommunityEvent() : new Op2CommunityTopic();
      $topic->setFromArray($entry);
      $topic->Op2Community = $op2Community;
      $topic->save($conn);

      if ($entry['COMMENT'])
      {
        $num = 1;
        foreach ($entry['COMMENT'] as $idx => $c)
        {
          $this->logSection('import', sprintf('comment(%d): %s', $idx, str_replace("\n", ' ', $c['content'])));

          $comment = $isEvent ? new Op2CommunityEventComment() : new Op2CommunityTopicComment();
          $comment->setFromArray($c);
          $comment->number = $num++;

          if ($isEvent)
          {
            $comment->Op2CommunityEvent = $topic;
          }
          else
          {
            $comment->Op2CommunityTopic = $topic;
          }

          $comment->save($conn);
        }
      }
    }
  }

  protected function isEvent($entry)
  {
    return preg_match('/^<p> +開催日時 : /', $entry['BODY']);
  }
}

