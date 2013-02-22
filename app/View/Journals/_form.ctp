<?php echo $this->Form->input('publisher'); ?>
<?php echo $this->Form->input('title', array('label' => __('Journal Title'))); ?>
<?php echo $this->Form->input('issn'); ?>
<?php echo $this->Form->input('ncid'); ?>
<?php echo $this->Form->input('publisher_policy', array('type' => 'select', 'label' => __('Publisher Policy'), 'empty' => true, 'options' => $policy_colors)); ?>
<?php echo $this->Form->input('publisher_open_file_version', array('type' => 'select', 'options' => $publisher_open_file_versions, 'empty' => true)); ?>
<?php echo $this->Form->input('publisher_open_condition', array('type' => 'textarea')); ?>
<?php echo $this->Form->input('publisher_request_method', array('type' => 'select', 'options' => $publisher_request_methods, 'empty' => true)); ?>
<?php echo $this->Form->input('publisher_contact_email', array()); ?>
<?php echo $this->Form->input('publisher_contact_zipcode', array()); ?>
<?php echo $this->Form->input('publisher_contact_address', array()); ?>
<?php echo $this->Form->input('publisher_contact_tel_no', array()); ?>
<?php echo $this->Form->input('publisher_contact_fax_no', array()); ?>
<?php echo $this->Form->input('publisher_remarks', array('type' => 'textarea')); ?>
<?php echo $this->Form->input('check_date', array('class' => 'datepicker')); ?>
<?php echo $this->Form->input('publisher_policy_uri'); ?>
<?php echo $this->Form->input('uri'); ?>