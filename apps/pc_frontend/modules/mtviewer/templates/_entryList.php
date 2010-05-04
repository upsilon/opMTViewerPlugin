<div class="dparts recentList"><div class="parts">
<div class="partsHeading">
<h3><?php echo $title ?></h3>
</div>

<?php if ($pager->getNbResults()): ?>
<?php use_helper('opMTViewer') ?>

<?php slot('pager'); ?>
<?php op_include_pager_navigation($pager, $sf_data->getRaw('internalUri')); ?>
<?php end_slot() ?>

<?php include_slot('pager'); ?>
<dl>
<?php foreach ($pager as $entry): ?>
<dt><?php echo op_format_date($entry->created_at, 'f') ?></dt>
<dd>
<?php echo $entryLinkCallback($entry) ?>
</dd>
<?php endforeach; ?>
</dl>
<?php include_slot('pager'); ?>
<?php else: ?>
<?php echo $errorEmpty ?>
<?php endif; ?>

</div>
</div>
