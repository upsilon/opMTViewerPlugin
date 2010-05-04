<?php if ($pager->getNbResults()): ?>

<?php slot('pager'); ?>
<?php op_include_pager_navigation($pager, '@mtviewer_member_list?page=%d&id='.$member->id); ?>
<?php end_slot() ?>

<div class="dparts memberList"><div class="parts">
<div class="partsHeading">
<h3>メンバー一覧</h3>
</div>
<?php include_slot('pager'); ?>
<ul>
<?php foreach ($pager->getResults() as $member): ?>
<li>
<?php echo link_to($member->name, '@mtviewer_member_diary?id='.$member->id) ?>
</li>
<?php endforeach; ?>
</ul>
<?php include_slot('pager'); ?>
</div>
</div>

<?php endif; ?>

