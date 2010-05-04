<?php
/**
 */
class PluginOp2CommunityEventTable extends Op2EntryTable
{
  public function getEvents($op2CommunityId, $limit = 5)
  {
    return $this->createQuery()
      ->where('op2_community_id = ?', $op2CommunityId)
      ->limit($limit)
      ->orderBy('created_at DESC')
      ->execute();
  }

  public function getListPager($op2CommunityId, $page = 1, $size = 20) 
  {
    $query = $this->createQuery()
      ->where('op2_community_id = ?', $op2CommunityId)
      ->orderBy('created_at DESC');
   
    $pager = new sfDoctrinePager('Op2CommunityEvent', $size);
    $pager->setQuery($query);
    $pager->setPage($page);
    $pager->init();
   
    return $pager;
  }
}
