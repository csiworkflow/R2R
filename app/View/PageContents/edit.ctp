<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('PageContent', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Edit %s', __('Page Content')); ?></legend>
				<?php
				echo $this->BootstrapForm->input('btn_label_ok_and_upload');
				echo $this->BootstrapForm->input('btn_label_ok');
				echo $this->BootstrapForm->input('btn_label_ng');
				echo $this->BootstrapForm->input('register_header');
				echo $this->BootstrapForm->input('register_footer');
				echo $this->BootstrapForm->input('register_upload_header');
				echo $this->BootstrapForm->input('register_upload_footer');
				echo $this->BootstrapForm->input('register_upload_complete_header');
				echo $this->BootstrapForm->input('register_upload_complete_footer');
				echo $this->BootstrapForm->input('register_ok_complete_header');
				echo $this->BootstrapForm->input('register_ok_complete_footer');
				echo $this->BootstrapForm->input('register_ng_complete_header');
				echo $this->BootstrapForm->input('register_ng_complete_footer');
				echo $this->BootstrapForm->hidden('id');
				?>
				<?php echo $this->BootstrapForm->submit(__('Submit'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PageContent.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('PageContent.id'))); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Page Contents')), array('action' => 'index'));?></li>
		</ul>
		</div>
	</div>
</div>