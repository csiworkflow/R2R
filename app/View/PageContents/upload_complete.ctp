<div>
    <h2><?php echo __('Register Upload Complete Page') ?></h2>
    <?php echo $this->Form->create('PageContent', array(
      'action' => 'update/' . $id . '/'. $view,
      'class' => 'form-horizontal',
      'inputDefaults' => array()));?>

    <?php echo $this->Form->input('register_upload_complete_header', array('type' => 'textarea', 'class' => 'ckeditor')); ?>
    <?php echo $this->Form->input('register_upload_complete_footer', array('type' => 'textarea', 'class' => 'ckeditor')); ?>

    <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
    <?php echo $this->Form->submit(__('Submit'));?>
    <?php echo $this->Form->end();?>
</div>
