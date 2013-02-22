<div>
    <?php $md = 'author_statuses_index'; ?>
    <a href="#help-modal-<?php echo $md; ?>" role="button" class="btn-help" data-toggle="modal"><?php echo $this->Html->image('help.png'); ?></a>
    <?php echo $this->element('help_modal', array('md' => $md)); ?>
    <h2><?php echo __('List %s', __('AuthorStatus'));?></h2>

    <table class="table table-striped table-bordered table-condensed">
        <tr>
            <th><?php echo __('Status Name'); ?></th>
            <th><?php echo __('Status Type'); ?></th>
            <th class="actions"><?php echo __('Actions');?></th>
        </tr>
        <?php foreach ($authorStatuses as $authorStatus): ?>
        <tr>
            <td>
                <?php echo $authorStatus['AuthorStatus']['name']; ?>
                <?php if ($authorStatus['AuthorStatus']['id'] == $authorDefaultOpenStatus['AuthorStatus']['id']):?>
                <span class="label label-info"><?php echo __('Default Open Status'); ?></span>
                <?php endif; ?>
            </td>
            <td>
                <?php echo $status_types[$authorStatus['AuthorStatus']['type']]; ?>
            </td>
            <td class="actions">
                <div class="btn-group">
                    <?php echo $this->Html->link(__('Edit'), array('controller' => 'author_statuses', 'action' => 'edit', $authorStatus['AuthorStatus']['id']), array('class' => 'btn')); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'author_statuses', 'action' => 'delete', $authorStatus['AuthorStatus']['id']), array('class' => 'btn'), __('Are you sure you want to delete # %s?', $authorStatus['AuthorStatus']['name'])); ?>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php echo $this->Html->link(__('Add %s', __('AuthorStatus')), array('controller' => 'author_statuses', 'action' => 'add'), array('class' => 'btn')); ?>
</div>

<hr />

<div>
    <h2><?php echo __('List %s', __('PublisherStatus'));?></h2>

    <table class="table table-striped table-bordered table-condensed">
        <tr>
            <th><?php echo __('Status Name'); ?></th>
            <th><?php echo __('Status Type'); ?></th>
            <th class="actions"><?php echo __('Actions');?></th>
        </tr>
        <?php foreach ($publisherStatuses as $publisherStatus): ?>
        <tr>
            <td>
                <?php echo $publisherStatus['PublisherStatus']['name']; ?>
                <?php if ($publisherStatus['PublisherStatus']['id'] == $publisherDefaultOpenStatus['PublisherStatus']['id']):?>
                <span class="label label-info"><?php echo __('Default Open Status'); ?></span>
                <?php endif; ?>
            </td>
            <td><?php echo $status_types[$publisherStatus['PublisherStatus']['type']]; ?></td>
            <td class="actions">
                <div class="btn-group">
                    <?php echo $this->Html->link(__('Edit'), array('controller' => 'publisher_statuses', 'action' => 'edit', $publisherStatus['PublisherStatus']['id']), array('class' => 'btn')); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'publisher_statuses', 'action' => 'delete', $publisherStatus['PublisherStatus']['id']), array('class' => 'btn'), __('Are you sure you want to delete # %s?', $publisherStatus['PublisherStatus']['name'])); ?>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php echo $this->Html->link(__('Add %s', __('PublisherStatus')), array('controller' => 'publisher_statuses', 'action' => 'add'), array('class' => 'btn')); ?>
</div>

<hr />

<div>
    <h2><?php echo __('List %s', __('CoauthorStatus'));?></h2>
    <table class="table table-striped table-bordered table-condensed">
        <tr>
            <th><?php echo __('Status Name'); ?></th>
            <th><?php echo __('Status Type'); ?></th>
            <th class="actions"><?php echo __('Actions');?></th>
        </tr>
        <?php foreach ($coauthorStatuses as $coauthorStatus): ?>
        <tr>
            <td>
                <?php echo $coauthorStatus['CoauthorStatus']['name']; ?>
                <?php if ($coauthorStatus['CoauthorStatus']['id'] == $coauthorDefaultOpenStatus['CoauthorStatus']['id']):?>
                <span class="label label-info"><?php echo __('Default Open Status'); ?></span>
                <?php endif; ?>
            </td>
            <td><?php echo $status_types[$coauthorStatus['CoauthorStatus']['type']]; ?></td>
            <td class="actions">
                <div class="btn-group">
                    <?php echo $this->Html->link(__('Edit'), array('controller' => 'coauthor_statuses', 'action' => 'edit', $coauthorStatus['CoauthorStatus']['id']), array('class' => 'btn')); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'coauthor_statuses', 'action' => 'delete', $coauthorStatus['CoauthorStatus']['id']), array('class' => 'btn'), __('Are you sure you want to delete # %s?', $coauthorStatus['CoauthorStatus']['name'])); ?>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php echo $this->Html->link(__('Add %s', __('CoauthorStatus')), array('controller' => 'coauthor_statuses', 'action' => 'add'), array('class' => 'btn')); ?>
</div>