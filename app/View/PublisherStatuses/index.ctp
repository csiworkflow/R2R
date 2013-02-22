<div class="row-fluid">
	<div class="span9">
		<h2><?php echo __('List %s', __('Publisher Statuses'));?></h2>

		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('name');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('type');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('sort');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('modified');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('delete_flg');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('deleted');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($publisherStatuses as $publisherStatus): ?>
			<tr>
				<td><?php echo h($publisherStatus['PublisherStatus']['id']); ?>&nbsp;</td>
				<td><?php echo h($publisherStatus['PublisherStatus']['name']); ?>&nbsp;</td>
				<td><?php echo h($publisherStatus['PublisherStatus']['type']); ?>&nbsp;</td>
				<td><?php echo h($publisherStatus['PublisherStatus']['sort']); ?>&nbsp;</td>
				<td><?php echo h($publisherStatus['PublisherStatus']['created']); ?>&nbsp;</td>
				<td><?php echo h($publisherStatus['PublisherStatus']['modified']); ?>&nbsp;</td>
				<td><?php echo h($publisherStatus['PublisherStatus']['delete_flg']); ?>&nbsp;</td>
				<td><?php echo h($publisherStatus['PublisherStatus']['deleted']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $publisherStatus['PublisherStatus']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $publisherStatus['PublisherStatus']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $publisherStatus['PublisherStatus']['id']), null, __('Are you sure you want to delete # %s?', $publisherStatus['PublisherStatus']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>

		<?php echo $this->BootstrapPaginator->pagination(); ?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Publisher Status')), array('action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
</div>