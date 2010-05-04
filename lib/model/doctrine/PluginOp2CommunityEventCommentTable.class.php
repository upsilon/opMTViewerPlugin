<?php
/**
 */
class PluginOp2CommunityEventCommentTable extends Op2CommentTable
{
  public function getCommentsQuery($op2CommunityEventId)
  {
    return $this->createQuery()
      ->where('op2_community_event_id = ?', $op2CommunityEventId);
  }
}
