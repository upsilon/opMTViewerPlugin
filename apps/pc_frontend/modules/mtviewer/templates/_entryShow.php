<div class="dparts commentList"><div class="parts">
<div class="partsHeading">
<h3>
<?php echo $title ?>
</h3>
</div>

<dl>
<dt><?php echo nl2br(op_format_date($entry->created_at, 'XDateTimeJaBr')) ?></dt>
<dd>
<div class="title">
<p class="heading"><?php echo $entry->title ?></p>
</div>
<div class="body">
<?php if ($entry->has_images): ?>
<?php endif ?>
<p class="text">
<?php echo op_url_cmd(op_decoration(nl2br($entry->body))) ?>
</p>
</div>
</dd>
</dl>

</div></div>

<?php include_component('mtviewer', 'entryShowComment', array('entry' => $sf_data->getRaw('entry'))) ?>

