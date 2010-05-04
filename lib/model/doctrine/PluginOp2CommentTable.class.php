<?php
/**
 */
class PluginOp2CommentTable extends Doctrine_Table
{
  public function getPager(Op2Entry $entry, $page, $size = 20)
  {
    $table = $entry->getCommentTable();
    $query = $table->getCommentsQuery($entry->id);

    $pager = new sfReversibleDoctrinePager('Op2Comment');
    $pager->setQuery($query);
    $pager->setPage($page);
    $pager->setMaxPerPage($size);
    $pager->init();

    return $pager;
  }
}
