<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Author Status');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($authorStatus['AuthorStatus']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Name'); ?></dt>
			<dd>
				<?php echo h($authorStatus['AuthorStatus']['name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Type'); ?></dt>
			<dd>
				<?php echo h($authorStatus['AuthorStatus']['type']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Sort'); ?></dt>
			<dd>
				<?php echo h($authorStatus['AuthorStatus']['sort']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($authorStatus['AuthorStatus']['created']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($authorStatus['AuthorStatus']['modified']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Delete Flg'); ?></dt>
			<dd>
				<?php echo h($authorStatus['AuthorStatus']['delete_flg']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Deleted'); ?></dt>
			<dd>
				<?php echo h($authorStatus['AuthorStatus']['deleted']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Author Status')), array('action' => 'edit', $authorStatus['AuthorStatus']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Author Status')), array('action' => 'delete', $authorStatus['AuthorStatus']['id']), null, __('Are you sure you want to delete # %s?', $authorStatus['AuthorStatus']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Author Statuses')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Author Status')), array('action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

