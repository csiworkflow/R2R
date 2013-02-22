<div>
    <?php echo $this->Form->create('DocumentTemplate', array('class' => 'form-horizontal'));?>
    <fieldset>
        <legend><?php echo __('Edit %s', __('DocumentTemplate')); ?></legend>
        <?php echo $this->partial('form'); ?>
        <?php echo $this->Form->hidden('id'); ?>
        <?php echo $this->Form->submit(__('Submit'));?>
    </fieldset>
    <?php echo $this->Form->end();?>
</div>