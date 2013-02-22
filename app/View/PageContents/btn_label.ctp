<div>
    <h2><?php echo __('Button Labels') ?></h2>
    <?php echo $this->Form->create('PageContent', array(
      'action' => 'update/' . $id . '/'. $view,
      'class' => 'form-horizontal',
      'inputDefaults' => array()));?>

    <?php echo $this->Form->input('btn_label_ok_and_upload', array('type' => 'text')); ?>
    <?php echo $this->Form->input('btn_label_ok', array('type' => 'text')); ?>
    <?php echo $this->Form->input('btn_label_ng', array('type' => 'text')); ?>

    <?php echo $this->Form->input('btn_display_type', array('type' => 'select', 'options' => $btn_display_types, 'class' => 'input-xxlarge')); ?>

    <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
    <?php echo $this->Form->submit(__('Submit'));?>
    <?php echo $this->Form->end();?>
</div>
