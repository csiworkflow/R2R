<div>
    <?php echo $this->Form->create('Journal', array(
      'class' => 'form-horizontal',
      'inputDefaults' => array('type' => 'text', 'div' => false, 'label' => false, 'divControls' => false)));?>
    <fieldset>
        <legend><?php echo __('Add %s', __('Journal')); ?></legend>
        <?php echo $this->partial('form'); ?>
        <?php echo $this->Form->submit(__('Submit'));?>
    </fieldset>
    <?php echo $this->Form->end();?>
</div>