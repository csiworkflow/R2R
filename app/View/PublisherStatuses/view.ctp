<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Publisher Status');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($publisherStatus['PublisherStatus']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Name'); ?></dt>
			<dd>
				<?php echo h($publisherStatus['PublisherStatus']['name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Type'); ?></dt>
			<dd>
				<?php echo h($publisherStatus['PublisherStatus']['type']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Sort'); ?></dt>
			<dd>
				<?php echo h($publisherStatus['PublisherStatus']['sort']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($publisherStatus['PublisherStatus']['created']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($publisherStatus['PublisherStatus']['modified']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Delete Flg'); ?></dt>
			<dd>
				<?php echo h($publisherStatus['PublisherStatus']['delete_flg']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Deleted'); ?></dt>
			<dd>
				<?php echo h($publisherStatus['PublisherStatus']['deleted']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Publisher Status')), array('action' => 'edit', $publisherStatus['PublisherStatus']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Publisher Status')), array('action' => 'delete', $publisherStatus['PublisherStatus']['id']), null, __('Are you sure you want to delete # %s?', $publisherStatus['PublisherStatus']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Publisher Statuses')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Publisher Status')), array('action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

