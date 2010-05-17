<?php slot('import_form') ?>
<div class="partsInfo">
<p>So-net SNS からダウンロードしたMT形式の日記データを取り込みます</p>
</div>
<?php op_include_form('import_form', $form, array(
  'isMultipart' => true ,
)) ?>
<?php end_slot() ?>

<?php op_include_box('import_form_box', get_slot('import_form'), array(
  'title' => '日記のインポート',
)) ?>

<?php slot('queue') ?>
<div class="partsInfo">
<p>現在のインポート待ち件数: <strong><?php echo count($queue) ?></strong> 件</p>
</div>
<ol>
<?php foreach ($queue as $job): ?>
<li>
<?php echo $job->File->original_filename ?> 
(アップロード: <?php echo op_format_date($job->File->created_at, 'f') ?>)
</li>
<?php endforeach ?>
</ol>
<?php end_slot() ?>

<?php op_include_box('import_queue', get_slot('queue'), array(
  'title' => 'インポート待ちのファイル',
)) ?>

