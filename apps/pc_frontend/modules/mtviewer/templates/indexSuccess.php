<?php op_include_box('mtviewer_import_box',
  'So-net SNS からダウンロードした書き込みデータを取り込みます',
  array(
    'title' => 'インポート',
  ))
?>

<?php op_include_form('import_form_box', $form, array('isMultipart' => true)) ?>

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

