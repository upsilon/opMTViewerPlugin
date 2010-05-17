<?php
/**
 */
class PluginImportJobTable extends Doctrine_Table
{
  public function getList()
  {
    return $this->createQuery()
      ->execute();
  }

  public function getDiaryJobs()
  {
    return $this->createQuery()
      ->where('member_id is not null')
      ->execute();
  }

  public function getTopicJobs()
  {
    return $this->createQuery()
      ->where('member_id is null')
      ->execute();
  }
}
