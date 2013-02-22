## <?php echo __('Import Journals'); ?>

CSVファイルのヘッダ情報を見て雑誌情報をインポートします。

利用できるヘッダは以下です。

<table class="table table-striped table-bordered table-condensed">
<?php foreach($schema as $field): ?>
<tr>
<th>
<?php if(in_array($field, array('title'))): ?>
<?php echo __('Journal Title'); ?>
<?php else: ?>
<?php echo __(Inflector::humanize($field)); ?>
<?php endif; ?>
<?php if(in_array($field, array('title'))): ?>
<span class="label label-important"><?php echo __('Required'); ?></span>
<?php endif; ?>
</th>
<td>
<?php echo $field; ?>
</td>
</tr>
<?php endforeach; ?>
</table>

<?php echo __('Publisher Policy'); ?>は以下のパラメータのみを受け付けます。
<table class="table table-striped table-bordered table-condensed">
<tr>
<td>
<?php foreach(Configure::read('Article.policy_colors') as $key => $value): ?>
<?php echo $key; ?>,
<?php endforeach; ?>
</td>
</tr>
</table>

<?php echo __('Publisher Open File Version'); ?>は以下のパラメータのみを受け付けます。
<table class="table table-striped table-bordered table-condensed">
<tr>
<td>
<?php foreach(Configure::read('Article.publisher_open_file_versions') as $key => $value): ?>
<?php echo $key; ?>,
<?php endforeach; ?>
</td>
</tr>
</table>

<?php echo __('Publisher Request Method'); ?>は以下のパラメータのみを受け付けます。
<table class="table table-striped table-bordered table-condensed">
<tr>
<td>
<?php foreach(Configure::read('Article.request_methods') as $key => $value): ?>
<?php echo $key; ?>,
<?php endforeach; ?>
</td>
</tr>
</table>
