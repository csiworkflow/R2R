<div>
    <h2>
        <?php echo __('PageContents') ?>
        <?php $md = 'page_contents_index'; ?>
        <a href="#help-modal-<?php echo $md; ?>" role="button" class="btn-help" data-toggle="modal"><?php echo $this->Html->image('help.png'); ?></a>
    </h2>
    <?php echo $this->element('help_modal', array('md' => $md)); ?>

    <?php echo $this->Html->link(__('Button Labels'), array('controller' => 'page_contents', 'action' => 'update', $contents['PageContent']['id'], 'btn_label'), array('class' => 'btn')); ?>
    <?php echo $this->Html->link(__('Register Page'), array('controller' => 'page_contents', 'action' => 'update', $contents['PageContent']['id'], 'register'), array('class' => 'btn')); ?>
    <?php echo $this->Html->link(__('Register Upload Page'), array('controller' => 'page_contents', 'action' => 'update', $contents['PageContent']['id'], 'upload'), array('class' => 'btn')); ?>
    <?php echo $this->Html->link(__('Register Upload Complete Page'), array('controller' => 'page_contents', 'action' => 'update', $contents['PageContent']['id'], 'upload_complete'), array('class' => 'btn')); ?>
    <?php echo $this->Html->link(__('Register OK Complete Page'), array('controller' => 'page_contents', 'action' => 'update', $contents['PageContent']['id'], 'ok_complete'), array('class' => 'btn')); ?>
    <?php echo $this->Html->link(__('Register NG Complete Page'), array('controller' => 'page_contents', 'action' => 'update', $contents['PageContent']['id'], 'ng_complete'), array('class' => 'btn')); ?>
</div>