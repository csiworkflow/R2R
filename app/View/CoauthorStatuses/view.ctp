<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Coauthor Status');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($coauthorStatus['CoauthorStatus']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Name'); ?></dt>
			<dd>
				<?php echo h($coauthorStatus['CoauthorStatus']['name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Type'); ?></dt>
			<dd>
				<?php echo h($coauthorStatus['CoauthorStatus']['type']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Sort'); ?></dt>
			<dd>
				<?php echo h($coauthorStatus['CoauthorStatus']['sort']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($coauthorStatus['CoauthorStatus']['created']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($coauthorStatus['CoauthorStatus']['modified']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Delete Flg'); ?></dt>
			<dd>
				<?php echo h($coauthorStatus['CoauthorStatus']['delete_flg']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Deleted'); ?></dt>
			<dd>
				<?php echo h($coauthorStatus['CoauthorStatus']['deleted']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Coauthor Status')), array('action' => 'edit', $coauthorStatus['CoauthorStatus']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Coauthor Status')), array('action' => 'delete', $coauthorStatus['CoauthorStatus']['id']), null, __('Are you sure you want to delete # %s?', $coauthorStatus['CoauthorStatus']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Coauthor Statuses')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Coauthor Status')), array('action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

