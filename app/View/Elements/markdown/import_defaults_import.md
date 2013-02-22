## <?php echo __d('import_default', 'Import Default'); ?>

CSVファイルのヘッダ情報を見て案件情報をインポートします。

利用できるヘッダは以下です。CSVファイルの1行目に英語の項目名を記述してください。

<table class="table table-striped table-bordered table-condensed">
<?php foreach($schema as $field): ?>
<tr>
<th>
<?php echo __(Inflector::humanize($field)); ?>
<?php if(in_array($field, array('title', 'contributor_author', 'date_issued'))): ?>
<span class="label label-important"><?php echo __('Required'); ?></span>
<?php endif; ?>
</th>
<td>
<?php echo $field; ?>
</td>
</tr>
<?php endforeach; ?>
</table>

<?php echo __('Langage Iso'); ?>は以下のパラメータのみを受け付けます。
<table class="table table-striped table-bordered table-condensed">
<tr>
<td>
<?php foreach(Configure::read('Article.language_isos') as $value): ?>
<?php echo $value; ?>,
<?php endforeach; ?>
</td>
</tr>
</table>

<?php echo __('Language Iso639 2'); ?>は以下のパラメータのみを受け付けます。
<table class="table table-striped table-bordered table-condensed">
<tr>
<td>
<?php foreach(Configure::read('Article.language_iso639_2s') as $value): ?>
<?php echo $value; ?>,
<?php endforeach; ?>
</td>
</tr>
</table>

<?php echo __('Type Nii'); ?>は以下のパラメータのみを受け付けます。
<table class="table table-striped table-bordered table-condensed">
<tr>
<td>
<?php foreach(Configure::read('Article.type_niis') as $value): ?>
<?php echo $value; ?>,
<?php endforeach; ?>
</td>
</tr>
</table>

<?php echo __('Peerreviewed'); ?>は以下のパラメータのみを受け付けます。
<table class="table table-striped table-bordered table-condensed">
<tr>
<td>
<?php foreach(Configure::read('Article.peerrevieweds') as $value): ?>
<?php echo $value; ?>,
<?php endforeach; ?>
</td>
</tr>
</table>

<?php echo __('Textversion'); ?>は以下のパラメータのみを受け付けます。
<table class="table table-striped table-bordered table-condensed">
<tr>
<td>
<?php foreach(Configure::read('Article.textversions') as $value): ?>
<?php echo $value; ?>,
<?php endforeach; ?>
</td>
</tr>
</table>

<?php echo __('Publicationstatus'); ?>は以下のパラメータのみを受け付けます。
<table class="table table-striped table-bordered table-condensed">
<tr>
<td>
<?php foreach(Configure::read('Article.publicationstatuses') as $value): ?>
<?php echo $value; ?>,
<?php endforeach; ?>
</td>
</tr>
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
