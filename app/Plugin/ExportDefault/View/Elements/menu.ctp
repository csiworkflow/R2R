<div class="well well-small well-gray">
    <h3 class="bulk-plugin-title"><?php echo __d('export_default', 'Export Default'); ?></h3>
    <?php echo $this->Form->create('Article', array(
      'url' => array('controller' => 'export_defaults', 'action' => 'export', 'plugin' => 'export_default'),
      'class' => 'form-search',
      'inputDefaults' => array('label' => false, 'div' => false))); ?>
    <?php echo $this->Form->input('keyword', array('type' => 'hidden')); ?>
    <?php echo $this->Form->input('author_status_id', array('type' => 'hidden')); ?>
    <?php echo $this->Form->input('publisher_status_id', array('type' => 'hidden')); ?>
    <?php echo $this->Form->input('coauthor_status_id', array('type' => 'hidden')); ?>
    <?php echo $this->Form->input('author_policy', array('type' => 'hidden')); ?>
    <?php echo $this->Form->input('file_status', array('type' => 'hidden')); ?>
    <?php echo $this->Form->input('publisher_embargo_period_complete', array('type' => 'hidden')); ?>
    <?php echo $this->Form->submit(__('Export')); ?>
    <?php echo $this->Form->end(); ?>
</div>
