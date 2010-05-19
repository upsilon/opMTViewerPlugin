<?php
/**
 */
class PluginOp2EntryTable extends Doctrine_Table
{
  public function findSameAs(Op2Entry $entry)
  {
    return $this->createQuery()
      ->where('title = ?', $entry->title)
      ->andWhere('op2_member_id = ?', $entry->op2_member_id)
      ->andWhere('created_at = ?', $entry->created_at)
      ->fetchOne();
  }
}
