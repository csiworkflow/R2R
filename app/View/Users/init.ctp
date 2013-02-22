<div class="users form">
    <h2><?php echo __('System Setup');?></h2>

    <div class="well">
        <?php echo __('Please create user account'); ?>
    </div>

    <?php echo $this->Form->create('User', array('url' => array('action' => 'init'), 'class' => ''));?>

    <?php echo $this->partial('form'); ?>

    <?php echo $this->Form->submit(__('Submit')); ?>
    <?php echo $this->Form->end();?>
</div>
