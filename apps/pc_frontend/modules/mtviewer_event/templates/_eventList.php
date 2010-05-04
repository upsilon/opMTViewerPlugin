<?php if (isset($events) && count($events) !== 0): ?>
<?php use_helper('opMTViewer') ?>
<?php use_stylesheet('/opMTViewerPlugin/css/topicList') ?>
<tr class="mtviewerEvent">
<th>過去のイベント</th>
<td>
<ul class="articleList">
<?php foreach ($events as $event): ?>
<li>
<span class="date"><?php echo op_format_date($event->created_at, 'XShortDateJa') ?></span>
<span class="title"><?php echo op_mtviewer_event_link($event) ?></span>
</li>
<?php endforeach ?>
</ul>
<div class="moreInfo">
<ul class="moreInfo">
<li><?php echo link_to(__('More'), '@mtviewer_community_event?id='.$op2Community->id); ?></li>
</ul>
</div>
</td>
</tr>
<?php endif ?>
