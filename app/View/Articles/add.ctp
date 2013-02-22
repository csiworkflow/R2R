<div>
    <h2><?php echo __('Add %s', __('Article')); ?></h2>
    <?php echo $this->Form->create('Article', array(
      'class' => 'form-horizontal',
      'inputDefaults' => array('type' => 'text', 'label' => false, 'div' => false, 'divControls' => false)));?>
    <?php echo $this->partial('form'); ?>
    <?php echo $this->Form->submit(__('Submit'));?>
    <?php echo $this->Form->end();?>
</div>
