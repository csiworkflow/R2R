<h2>
    <?php echo __('Plugins'); ?>
    <?php $md = 'pages_plugins'; ?>
    <a href="#help-modal-<?php echo $md; ?>" role="button" class="btn-help" data-toggle="modal"><?php echo $this->Html->image('help.png'); ?></a>
</h2>
<?php echo $this->element('help_modal', array('md' => $md)); ?>

<h3><?php echo __('Import Plugins'); ?></h3>

<?php foreach($import_plugins as $plugin): ?>
<?php echo $this->element('setting', array(), array('plugin' => $plugin)); ?>
<?php endforeach; ?>

<h3><?php echo __('Bulk Plugins'); ?></h3>

<?php foreach($bulk_plugins as $plugin): ?>
<?php echo $this->element('setting', array(), array('plugin' => $plugin)); ?>
<?php endforeach; ?>

<h3>
    <?php echo __('Filter Plugins'); ?>
    <?php $md = 'pages_plugins_filter'; ?>
    <a href="#help-modal-<?php echo $md; ?>" role="button" class="btn-help" data-toggle="modal"><?php echo $this->Html->image('help.png'); ?></a>
</h3>
<?php echo $this->element('help_modal', array('md' => $md)); ?>

<?php $i = 1; ?>
<?php foreach($filter_plugins as $plugin): ?>
<span class="label label-info"><?php echo $i; ?></span>
<?php echo $this->element('setting', array(), array('plugin' => $plugin)); ?>
<?php $i++; ?>
<?php endforeach; ?>







