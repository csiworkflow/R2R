<div>
    <h2>
        <?php echo __('CSV Import');?>
        <?php $md = 'import_defaults_import'; ?>
        <a href="#help-modal-<?php echo $md; ?>" role="button" class="btn-help" data-toggle="modal"><?php echo $this->Html->image('help.png'); ?></a>
    </h2>
    <?php echo $this->element('help_modal', array('md' => $md)); ?>
    <?php if(!empty($result)): ?>
    <div class="well well-small">
        <p><strong><?php echo number_format($count); ?></strong>件インポートされました。
        <?php echo __('Follow line has not been imported.'); ?></p>
        <table class="table table-striped table-bordered table-condensed">
            <thead>
                <tr>
                    <th>
                        <?php echo __('Line Number'); ?> (<?php echo __('Exclude header') ?>)
                    </th>
                    <th>
                        <?php echo __('Validation Fields'); ?>
                    </th>
                    <th>
                        <?php echo __('Line Info'); ?>
                    </th>
                </tr>
            </thead>
            <?php foreach($result as $key => $value): ?>
            <tbody>
                <td>
                    <?php echo number_format($key); ?>
                </td>
                <td>
                    <ul>
                        <?php if (empty($value['validationErrors'])): ?>
                        <li><?php echo $value['message']; ?></li>
                        <?php endif; ?>
                        <?php foreach($value['validationErrors'] as $fieldName => $v): ?>
                        <li>[<?php echo __(Inflector::humanize($fieldName)); ?>] <?php echo $v[0]; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </td>
                <td>
                    <?php pr($value['line']); ?>
                </td>
            </tbody>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>

    <?php echo $this->Form->create('Article', array(
      'url' => array('controller' => 'import_defaults', 'action' => 'import', 'plugin' => 'import_default'),
      'inputDefaults' => array('label' => false),
      'type' => 'file'));?>

    <?php echo $this->Form->input('csv', array('type' => 'file')); ?>

    <?php echo $this->Form->submit(__('Import')); ?>
    <?php echo $this->Form->end();?>
</div>