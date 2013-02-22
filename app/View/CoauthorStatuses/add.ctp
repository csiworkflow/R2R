<div>
    <?php echo $this->Form->create('CoauthorStatus', array(
      'class' => 'form-horizontal',
      'inputDefaults' => array('type' => 'text', 'div' => false)));?>
    <fieldset>
        <legend><?php echo __('Add %s', __('CoauthorStatus')); ?></legend>
        <?php echo $this->partial('form'); ?>
        <?php echo $this->Form->submit(__('Submit'));?>
    </fieldset>
    <?php echo $this->Form->end();?>
</div>