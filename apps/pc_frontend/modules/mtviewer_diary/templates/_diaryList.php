<?php use_helper('opMTViewer') ?>

<?php if (isset($diaries) && count($diaries) !== 0): ?>
<div id="homeRecentList_<?php echo $gadget->id ?>" class="dparts homeRecentList"><div class="parts">
<div class="partsHeading"><h3>過去の日記</h3></div>
<div class="block">

<ul class="articleList">
<?php foreach ($diaries as $diary): ?>
<li>
<span class="date"><?php echo op_format_date($diary->created_at, 'XShortDateJa') ?></span>
<?php echo op_mtviewer_diary_link($diary) ?>
</li>
<?php endforeach ?>
</ul>

<div class="moreInfo">
<ul class="moreInfo">
<li><?php echo link_to(__('More'), '@mtviewer_member_diary?id='.$op2Member->id) ?></li>
</ul>
</div>

</div>
</div></div>
<?php endif ?>
