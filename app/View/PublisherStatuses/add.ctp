<div>
    <?php echo $this->Form->create('PublisherStatus', array(
      'class' => 'form-horizontal',
      'inputDefaults' => array('type' => 'text', 'div' => false)));?>
    <fieldset>
        <legend><?php echo __('Add %s', __('PublisherStatus')); ?></legend>
        <?php echo $this->partial('form'); ?>
        <?php echo $this->Form->submit(__('Submit'));?>
    </fieldset>
    <?php echo $this->Form->end();?>
</div>