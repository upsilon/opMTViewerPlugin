<?php
/**
 */
class PluginOp2DiaryTable extends Op2EntryTable
{
  public function getDiaries($op2MemberId, $limit = 5)
  {
    return $this->createQuery()
      ->where('op2_member_id = ?', $op2MemberId)
      ->limit($limit)
      ->orderBy('created_at DESC')
      ->execute();
  }

  public function getListPager($op2MemberId, $page = 1, $size = 20) 
  {
    $query = $this->createQuery()
      ->where('op2_member_id = ?', $op2MemberId)
      ->orderBy('created_at DESC');
   
    $pager = new sfDoctrinePager('Op2Diary', $size);
    $pager->setQuery($query);
    $pager->setPage($page);
    $pager->init();
   
    return $pager;
  }
}
