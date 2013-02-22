<?php echo $this->Form->input('name', array('type' => 'text', 'class' => 'input-xxlarge', 'label' => __('Template Name'))); ?>
<hr />
<?php
  echo $this->Form->input('body_top', array('class' => 'template-body'));
  echo $this->Form->input('author_url_flg', array('type' => 'checkbox'));
  echo $this->Form->input('body_bottom', array('class' => 'template-body'));
?>