<?php echo include_partial('mtviewer/entryList', array(
  'title' => 'イベント一覧',
  'pager' => $pager,
  'internalUri' => '@mtviewer_community_event?page=%d&id='.$op2Community->id,
  'entryLinkCallback' => 'op_mtviewer_event_link',
  'errorEmpty' => 'イベントはありません',
)) ?>
