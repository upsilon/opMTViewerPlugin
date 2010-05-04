<?php
/**
 */
class PluginOp2DiaryCommentTable extends Op2CommentTable
{
  public function getCommentsQuery($op2DiaryId)
  {
    return $this->createQuery()
      ->where('op2_diary_id = ?', $op2DiaryId);
  }
}
