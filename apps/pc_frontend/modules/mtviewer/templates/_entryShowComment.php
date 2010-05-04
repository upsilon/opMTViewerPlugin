<?php if ($pager->getNbResults()): ?>
<div class="dparts commentList"><div class="parts">
<div class="partsHeading"><h3>コメント</h3></div>
<?php foreach ($pager as $comment): ?>
<dl>
<dt><?php echo nl2br(op_format_date($comment->created_at, 'XDateTimeJaBr')) ?></dt>
<dd>
<div class="title">
<p class="heading"><strong><?php echo $comment->number ?></strong>:
<?php if ($_member = $comment->Op2Member): ?>
<?php echo link_to($_member->name, '@mtviewer_member_diary?id='.$_member->id, array('popup' => true)) ?>
<?php endif ?>
</p>
</div>
<div class="body">
<?php if ($comment->has_images): ?>
<?php endif ?>
<p class="text">
<?php echo op_url_cmd(nl2br($comment->body)) ?>
</p>
</div>
</dd>
</dl>
<?php endforeach ?>
</div></div>
<?php endif ?>
