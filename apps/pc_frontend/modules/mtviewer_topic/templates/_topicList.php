<?php if (isset($topics) && count($topics) !== 0): ?>
<?php use_helper('opMTViewer') ?>
<?php use_stylesheet('/opMTViewerPlugin/css/topicList') ?>
<tr class="mtviewerTopic">
<th>過去のトピック</th>
<td>
<ul class="articleList">
<?php foreach ($topics as $topic): ?>
<li>
<span class="date"><?php echo op_format_date($topic->created_at, 'XShortDateJa') ?></span>
<span class="title"><?php echo op_mtviewer_topic_link($topic) ?></span>
</li>
<?php endforeach ?>
</ul>
<div class="moreInfo">
<ul class="moreInfo">
<li><?php echo link_to(__('More'), '@mtviewer_community_topic?id='.$op2Community->id); ?></li>
</ul>
</div>
</td>
</tr>
<?php endif ?>
