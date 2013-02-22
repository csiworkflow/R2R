<div class="users form">
    <h2><?php echo __('Add User');?></h2>

    <?php echo $this->Form->create('User', array('url' => array('action' => 'add'), 'class' => ''));?>

    <?php echo $this->partial('form'); ?>

    <?php echo $this->Form->submit(__('Submit')); ?>
    <?php echo $this->Form->end();?>
</div>
