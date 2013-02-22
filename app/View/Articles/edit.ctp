<div class="action-menu">
    <div class="action-menu-inner">
        <?php echo $this->Html->link(__('View'), array('controller' => 'articles', 'action' => 'view', $this->data['Article']['id']), array('class' => 'btn')); ?>

        <a href="#article-modal-document-template" role="button" class="btn" data-toggle="modal"><?php echo __('DocumentTemplate'); ?></a>
    </div>
</div>
<div>
    <h2><?php echo __('Edit %s', __('Article')); ?></h2>
    <?php echo $this->Form->create('Article', array(
      'class' => 'form-horizontal',
      'inputDefaults' => array('type' => 'text', 'label' => false, 'div' => false, 'divControls' => false)));?>
    <?php echo $this->partial('form'); ?>
    <?php echo $this->Form->hidden('id'); ?>
    <?php echo $this->Form->hidden('hash'); ?>
    <?php echo $this->Form->submit(__('Submit'));?>
    <?php echo $this->Form->end();?>
</div>

<div id="article-modal-document-template" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="article-modal-label-document-template" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="article-modal-label-document-template"><?php echo __('DocumentTemplate'); ?></h3>
    </div>
    <div class="modal-body">
        <ul>
            <?php foreach($templates as $id => $template): ?>
            <li><?php echo $this->Html->link($template, array('controller' => 'document_templates', 'action' => 'clip', $id, $this->data['Article']['id']), array('target' => '_blank')); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Close'); ?></button>
</div></div>