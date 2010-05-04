<?php echo include_partial('mtviewer/entryList', array(
  'title' => '日記一覧',
  'pager' => $pager,
  'internalUri' => '@mtviewer_member_diary?page=%d&id='.$op2Member->id,
  'entryLinkCallback' => 'op_mtviewer_diary_link',
  'errorEmpty' => '日記はありません',
)) ?>
