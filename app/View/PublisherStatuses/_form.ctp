<?php
  echo $this->Form->input('name', array('label' => __('Status Name')));
  echo $this->Form->input('type', array('type' => 'select', 'options' => $status_types, 'label' => __('Status Type')));
?>