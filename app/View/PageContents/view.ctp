<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Page Content');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($pageContent['PageContent']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Btn Label Ok And Upload'); ?></dt>
			<dd>
				<?php echo h($pageContent['PageContent']['btn_label_ok_and_upload']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Btn Label Ok'); ?></dt>
			<dd>
				<?php echo h($pageContent['PageContent']['btn_label_ok']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Btn Label Ng'); ?></dt>
			<dd>
				<?php echo h($pageContent['PageContent']['btn_label_ng']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Register Header'); ?></dt>
			<dd>
				<?php echo h($pageContent['PageContent']['register_header']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Register Footer'); ?></dt>
			<dd>
				<?php echo h($pageContent['PageContent']['register_footer']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Register Upload Header'); ?></dt>
			<dd>
				<?php echo h($pageContent['PageContent']['register_upload_header']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Register Upload Footer'); ?></dt>
			<dd>
				<?php echo h($pageContent['PageContent']['register_upload_footer']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Register Upload Complete Header'); ?></dt>
			<dd>
				<?php echo h($pageContent['PageContent']['register_upload_complete_header']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Register Upload Complete Footer'); ?></dt>
			<dd>
				<?php echo h($pageContent['PageContent']['register_upload_complete_footer']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Register Ok Complete Header'); ?></dt>
			<dd>
				<?php echo h($pageContent['PageContent']['register_ok_complete_header']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Register Ok Complete Footer'); ?></dt>
			<dd>
				<?php echo h($pageContent['PageContent']['register_ok_complete_footer']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Register Ng Complete Header'); ?></dt>
			<dd>
				<?php echo h($pageContent['PageContent']['register_ng_complete_header']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Register Ng Complete Footer'); ?></dt>
			<dd>
				<?php echo h($pageContent['PageContent']['register_ng_complete_footer']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($pageContent['PageContent']['created']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($pageContent['PageContent']['modified']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Page Content')), array('action' => 'edit', $pageContent['PageContent']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Page Content')), array('action' => 'delete', $pageContent['PageContent']['id']), null, __('Are you sure you want to delete # %s?', $pageContent['PageContent']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Page Contents')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Page Content')), array('action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

