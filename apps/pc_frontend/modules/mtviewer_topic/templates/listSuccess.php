<?php echo include_partial('mtviewer/entryList', array(
  'title' => 'トピック一覧',
  'pager' => $pager,
  'internalUri' => '@mtviewer_community_topic?page=%d&id='.$op2Community->id,
  'entryLinkCallback' => 'op_mtviewer_topic_link',
  'errorEmpty' => 'トピックはありません',
)) ?>
