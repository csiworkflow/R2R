<div>
    <h2>
        <?php echo __('List %s', __('DocumentTemplate'));?>
        <?php $md = 'document_templates_index'; ?>
        <a href="#help-modal-<?php echo $md; ?>" role="button" class="btn-help" data-toggle="modal"><?php echo $this->Html->image('help.png'); ?></a>
    </h2>
    <?php echo $this->element('help_modal', array('md' => $md)); ?>

    <p>
        <?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
    </p>

    <table class="table table-striped table-bordered table-condensed">
        <tr>
            <th><?php echo $this->Paginator->sort('id');?></th>
            <th><?php echo $this->Paginator->sort('name', __('Template Name'));?></th>
            <th><?php echo $this->Paginator->sort('body_top', __('Body'));?></th>
            <th><?php echo $this->Paginator->sort('modified');?></th>
            <th class="actions"><?php echo __('Actions');?></th>
        </tr>
        <?php foreach ($documentTemplates as $documentTemplate): ?>
        <tr>
            <td><?php echo $documentTemplate['DocumentTemplate']['id']; ?></td>
            <td>
                <?php echo $this->Html->link($documentTemplate['DocumentTemplate']['name'], array('action' => 'view', $documentTemplate['DocumentTemplate']['id'], 'escape' => false)); ?>
            </td>
            <td><?php echo nl2br(mb_strimwidth($documentTemplate['DocumentTemplate']['body_top'], 0, 200, STRTRIM_SUFFIX)); ?></td>
            <td><?php echo $documentTemplate['DocumentTemplate']['modified']; ?></td>
            <td class="actions">
                <div class="btn-group">
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $documentTemplate['DocumentTemplate']['id']), array('class' => 'btn')); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $documentTemplate['DocumentTemplate']['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $documentTemplate['DocumentTemplate']['name'])); ?>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php echo $this->Paginator->pagination(); ?>
</div>