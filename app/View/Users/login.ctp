<div class="users form">
    <?php echo $this->Form->create('User', array('url' => array('action' => 'login')));?>
    <fieldset>
        <legend><?php echo __('Login');?></legend>
        <?php
          echo $this->Form->input('username', array('type' => 'text'));
          echo $this->Form->input('password');
        ?>
    </fieldset>
    <?php echo $this->Form->submit(__('Login')); ?>
    <?php echo $this->Form->end();?>
</div>