<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('ArticleHistory', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Add %s', __('Article History')); ?></legend>
				<?php
				echo $this->BootstrapForm->input('article_id');
				echo $this->BootstrapForm->input('user_id');
				echo $this->BootstrapForm->input('hash');
				echo $this->BootstrapForm->input('file_count');
				echo $this->BootstrapForm->input('title');
				echo $this->BootstrapForm->input('title_alternative');
				echo $this->BootstrapForm->input('contributor_author');
				echo $this->BootstrapForm->input('creator_alternative');
				echo $this->BootstrapForm->input('creator_transcription');
				echo $this->BootstrapForm->input('contributor_affiliation');
				echo $this->BootstrapForm->input('date_issued');
				echo $this->BootstrapForm->input('identifier_citation');
				echo $this->BootstrapForm->input('identifier_title');
				echo $this->BootstrapForm->input('identifier_volume');
				echo $this->BootstrapForm->input('identifier_number');
				echo $this->BootstrapForm->input('identifier_spage');
				echo $this->BootstrapForm->input('identifier_epage');
				echo $this->BootstrapForm->input('identifier_isbn');
				echo $this->BootstrapForm->input('identifier_issn');
				echo $this->BootstrapForm->input('description_abstract');
				echo $this->BootstrapForm->input('subject');
				echo $this->BootstrapForm->input('description');
				echo $this->BootstrapForm->input('description_tableofcontents');
				echo $this->BootstrapForm->input('identifier_doi');
				echo $this->BootstrapForm->input('rights');
				echo $this->BootstrapForm->input('rights_uri');
				echo $this->BootstrapForm->input('language_iso');
				echo $this->BootstrapForm->input('language_iso639_2');
				echo $this->BootstrapForm->input('publisher');
				echo $this->BootstrapForm->input('publisher_alternative');
				echo $this->BootstrapForm->input('relation_uri');
				echo $this->BootstrapForm->input('type_nii');
				echo $this->BootstrapForm->input('type');
				echo $this->BootstrapForm->input('peerreviewed');
				echo $this->BootstrapForm->input('textversion');
				echo $this->BootstrapForm->input('publicationstatus');
				echo $this->BootstrapForm->input('identifier_ncid');
				echo $this->BootstrapForm->input('identifier_pmid');
				echo $this->BootstrapForm->input('local');
				echo $this->BootstrapForm->input('source');
				echo $this->BootstrapForm->input('publisher_policy');
				echo $this->BootstrapForm->input('publisher_policy_type');
				echo $this->BootstrapForm->input('publisher_open_condition');
				echo $this->BootstrapForm->input('publisher_source_uri');
				echo $this->BootstrapForm->input('publisher_open_file_version');
				echo $this->BootstrapForm->input('publisher_embargo_period');
				echo $this->BootstrapForm->input('publisher_embargo_close_action');
				echo $this->BootstrapForm->input('publisher_policy_uri');
				echo $this->BootstrapForm->input('publisher_other');
				echo $this->BootstrapForm->input('publisher_source');
				echo $this->BootstrapForm->input('publisher_request_method');
				echo $this->BootstrapForm->input('publisher_contact_info');
				echo $this->BootstrapForm->input('publisher_remarks');
				echo $this->BootstrapForm->input('author_name');
				echo $this->BootstrapForm->input('author_id');
				echo $this->BootstrapForm->input('author_policy');
				echo $this->BootstrapForm->input('author_comment');
				echo $this->BootstrapForm->input('author_request_method');
				echo $this->BootstrapForm->input('author_contact_info');
				echo $this->BootstrapForm->input('author_coauthor_flg');
				echo $this->BootstrapForm->input('author_remarks');
				echo $this->BootstrapForm->input('publisher_status_id');
				echo $this->BootstrapForm->input('author_status_id');
				echo $this->BootstrapForm->input('coauthor_status_id');
				echo $this->BootstrapForm->input('coauthor_name1');
				echo $this->BootstrapForm->input('coauthor_id1');
				echo $this->BootstrapForm->input('coauthor_policy1');
				echo $this->BootstrapForm->input('coauthor_request_method1');
				echo $this->BootstrapForm->input('coauthor_contact_info1');
				echo $this->BootstrapForm->input('coauthor_remarks1');
				echo $this->BootstrapForm->input('coauthor_name2');
				echo $this->BootstrapForm->input('coauthor_id2');
				echo $this->BootstrapForm->input('coauthor_policy2');
				echo $this->BootstrapForm->input('coauthor_request_method2');
				echo $this->BootstrapForm->input('coauthor_contact_info2');
				echo $this->BootstrapForm->input('coauthor_remarks2');
				echo $this->BootstrapForm->input('coauthor_name3');
				echo $this->BootstrapForm->input('coauthor_id3');
				echo $this->BootstrapForm->input('coauthor_policy3');
				echo $this->BootstrapForm->input('coauthor_request_method3');
				echo $this->BootstrapForm->input('coauthor_contact_info3');
				echo $this->BootstrapForm->input('coauthor_remarks3');
				echo $this->BootstrapForm->input('coauthor_name4');
				echo $this->BootstrapForm->input('coauthor_id4');
				echo $this->BootstrapForm->input('coauthor_policy4');
				echo $this->BootstrapForm->input('coauthor_request_method4');
				echo $this->BootstrapForm->input('coauthor_contact_info4');
				echo $this->BootstrapForm->input('coauthor_remarks4');
				echo $this->BootstrapForm->input('coauthor_name5');
				echo $this->BootstrapForm->input('coauthor_id5');
				echo $this->BootstrapForm->input('coauthor_policy5');
				echo $this->BootstrapForm->input('coauthor_request_method5');
				echo $this->BootstrapForm->input('coauthor_contact_info5');
				echo $this->BootstrapForm->input('coauthor_remarks5');
				echo $this->BootstrapForm->input('delete_flg');
				echo $this->BootstrapForm->input('deleted');
				?>
				<?php echo $this->BootstrapForm->submit(__('Submit'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Article Histories')), array('action' => 'index'));?></li>
		</ul>
		</div>
	</div>
</div>