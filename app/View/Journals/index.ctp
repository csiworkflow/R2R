<div>
    <h2>
        <?php echo __('List %s', __('Journal'));?>
        <?php $md = 'journals_index'; ?>
        <a href="#help-modal-<?php echo $md; ?>" role="button" class="btn-help" data-toggle="modal"><?php echo $this->Html->image('help.png'); ?></a>
    </h2>
    <?php echo $this->element('help_modal', array('md' => $md)); ?>

    <?php echo $this->Form->create('Journal', array(
      'action' => 'index',
      'class' => 'form-search',
      'inputDefaults' => array('label' => false, 'div' => false))); ?>
    <?php echo $this->Form->input('keyword', array('type' => 'text', 'placeholder' => '雑誌名, 出版社名、ISSN')); ?>
    <?php echo $this->Form->input('publisher_policy', array('type' => 'select', 'options' => $policy_colors, 'empty' => true)); ?>
    <?php echo $this->Form->submit(__('Search'), array('div' => false)); ?>
    <?php echo $this->Form->end(); ?>

    <p>
        <?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
    </p>
    <table class="table table-striped table-bordered table-condensed">
        <tr>
            <th><?php echo $this->Paginator->sort('id');?></th>
            <th><?php echo $this->Paginator->sort('title', __('Journal Title'));?></th>
            <th><?php echo $this->Paginator->sort('publisher');?></th>
            <th><?php echo $this->Paginator->sort('issn');?></th>
            <th><?php echo $this->Paginator->sort('ncid');?></th>
            <th><?php echo $this->Paginator->sort('publisher_policy');?></th>
            <th><?php echo $this->Paginator->sort('publisher_open_file_version');?></th>
            <th><?php echo $this->Paginator->sort('check_date');?></th>
            <th><?php echo $this->Paginator->sort('created');?></th>
            <th class="actions"><?php echo __('Actions');?></th>
        </tr>
        <?php foreach ($journals as $journal): ?>
        <tr>
            <td><?php echo $journal['Journal']['id']; ?></td>
            <td>
                <?php echo $this->Html->link($journal['Journal']['title'], array('action' => 'view', $journal['Journal']['id']), array('escape' => false)); ?>
            </td>
            <td><?php echo $journal['Journal']['publisher']; ?></td>
            <td><?php echo $journal['Journal']['issn']; ?></td>
            <td><?php echo $journal['Journal']['ncid']; ?></td>
            <td>
                <?php if (!empty($policy_colors[$journal['Journal']['publisher_policy']])): ?>
                <?php echo $policy_colors[$journal['Journal']['publisher_policy']]; ?>
                <?php else: ?>
                ---
                <?php endif; ?>
            </td>
            <td>
                <?php if (!empty($publisher_open_file_versions[$journal['Journal']['publisher_open_file_version']])): ?>
                <?php echo $publisher_open_file_versions[$journal['Journal']['publisher_open_file_version']]; ?>
                <?php else: ?>
                ---
                <?php endif; ?>
            </td>
            <td><?php echo $journal['Journal']['check_date']; ?></td>
            <td><?php echo $journal['Journal']['created']; ?></td>
            <td class="actions">
                <div class="btn-group">
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $journal['Journal']['id']), array('class' => 'btn')); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $journal['Journal']['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $journal['Journal']['id'])); ?>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php echo $this->Paginator->pagination(); ?>
</div>