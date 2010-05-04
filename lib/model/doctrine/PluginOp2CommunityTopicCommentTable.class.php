<?php
/**
 */
class PluginOp2CommunityTopicCommentTable extends Op2CommentTable
{
  public function getCommentsQuery($op2CommunityTopicId)
  {
    return $this->createQuery()
      ->where('op2_community_topic_id = ?', $op2CommunityTopicId);
  }
}
