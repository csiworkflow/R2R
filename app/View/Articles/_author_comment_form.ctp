<?php echo $this->Form->create('Article', array(
  'class' => 'form-horizontal',
  'action' => $this->action . '/' . $hash,
  'inputDefaults' => array('type' => 'text', 'label' => false, 'div' => false, 'divControls' => false)));?>
<?php echo $this->Form->input('author_comment', array('type' => 'textarea', 'class' => 'input-xlarge')); ?>
<?php echo $this->Form->hidden('id'); ?>
<?php echo $this->Form->submit(__('Submit'), array('div' => false));?>
<?php echo $this->Form->end();?>
