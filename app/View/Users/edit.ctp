<div class="users form">

    <h2><?php echo __('Edit User');?></h2>
    <div class="btn-group well">
        <?php echo $this->Html->link(__('Back'), array('action' => 'index'), array('class' => 'btn')); ?>
        <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), array('class' => 'btn')); ?>
    </div>

    <?php echo $this->Form->create('User', array('url' => array('action' => 'edit'), 'class' => ''));?>
    <?php echo $this->partial('form'); ?>
    <?php echo $this->Form->input('id'); ?>
    <?php echo $this->Form->submit(__('Submit')); ?>
    <?php echo $this->Form->end();?>
</div>
