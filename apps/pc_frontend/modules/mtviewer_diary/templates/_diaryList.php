<?php use_helper('opMTViewer') ?>

<?php if ($gadget->type === 'contents' || $diaries): ?>
<div id="homeRecentList_<?php echo $gadget->id ?>" class="dparts homeRecentList"><div class="parts">
<div class="partsHeading"><h3>過去の日記</h3></div>
<div class="block">

<?php if ($diaries): ?>
<ul class="articleList">
<?php foreach ($diaries as $diary): ?>
<li>
<span class="date"><?php echo op_format_date($diary->created_at, 'XShortDateJa') ?></span>
<?php echo op_mtviewer_diary_link($diary) ?>
</li>
<?php endforeach ?>
</ul>
<?php endif ?>

<div class="moreInfo">
<ul class="moreInfo">
<?php if ($diaries): ?>
<li><?php echo link_to(__('More'), '@mtviewer_member_diary?id='.$op2Member->id) ?></li>
<?php endif ?>
<?php if ($gadget->type === 'contents'): ?>
<li><?php echo link_to('日記をインポートする', '@mtviewer_import_diary') ?></li>
<?php endif ?>
</ul>
</div>

</div>
</div></div>
<?php endif ?>
