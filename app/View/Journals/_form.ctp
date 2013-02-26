<table class="table table-bordered table-condensed article-table">
    <tbody>
        <?php if($this->action === 'edit'): ?>
        <tr>
            <th>
                <?php echo __('Id'); ?>
            </th>
            <td>
                <?php echo $this->data['Journal']['id']; ?>
                <?php echo $this->Form->hidden('id'); ?>
            </td>
        </tr>
        <?php endif; ?>
        <tr>
            <th><?php echo __('Publisher'); ?></th>
            <td>
                <?php echo $this->Form->input('publisher'); ?>
            </td>
        </tr>
        <tr>
            <th>
                <?php echo __('Journal Title') ?>
                <span class="label label-important"><?php echo __('Required'); ?></span>
            </th>
            <td>
                <?php echo $this->Form->input('title'); ?>
            </td>
        </tr>
        <tr>
            <th><?php echo __('Issn'); ?></th>
            <td>
                <?php echo $this->Form->input('issn'); ?>
            </td>
        </tr>
        <tr>
            <th><?php echo __('Ncid'); ?></th>
            <td>
                <?php echo $this->Form->input('ncid'); ?>
            </td>
        </tr>
        <tr>
            <th><?php echo __('Publisher Policy'); ?></th>
            <td>
                <?php echo $this->Form->input('publisher_policy', array('type' => 'select', 'empty' => true, 'options' => $policy_colors)); ?>
            </td>
        </tr>
        <tr>
            <th><?php echo __('Policy Open Type Version'); ?></th>
            <td>
                <?php echo $this->Form->input('publisher_open_file_version', array('type' => 'select', 'options' => $publisher_open_file_versions, 'empty' => true)); ?>
            </td>
        </tr>
        <tr>
            <th><?php echo __('Publisher Open Condition'); ?></th>
            <td>
                <?php echo $this->Form->input('publisher_open_condition', array('type' => 'textarea')); ?>
            </td>
        </tr>
        <tr>
            <th><?php echo __('Publisher Request Method'); ?></th>
            <td>
                <?php echo $this->Form->input('publisher_request_method', array('type' => 'select', 'options' => $publisher_request_methods, 'empty' => true)); ?>
            </td>
        </tr>
        <tr>
            <th><?php echo __('Publisher Contact Email'); ?></th>
            <td>
                <?php echo $this->Form->input('publisher_contact_email', array()); ?>
            </td>
        </tr>
        <tr>
            <th><?php echo __('Publisher Contact Zipcode'); ?></th>
            <td>
                <?php echo $this->Form->input('publisher_contact_zipcode', array()); ?>
            </td>
        </tr>
        <tr>
            <th><?php echo __('Publisher Contact Address'); ?></th>
            <td>
                <?php echo $this->Form->input('publisher_contact_address', array()); ?>
            </td>
        </tr>
        <tr>
            <th><?php echo __('Publisher Contact Tel No'); ?></th>
            <td>
                <?php echo $this->Form->input('publisher_contact_tel_no', array()); ?>
            </td>
        </tr>
        <tr>
            <th><?php echo __('Publisher Contact Fax No'); ?></th>
            <td>
                <?php echo $this->Form->input('publisher_contact_fax_no', array()); ?>
            </td>
        </tr>
        <tr>
            <th><?php echo __('Publisher Remarks'); ?></th>
            <td>
                <?php echo $this->Form->input('publisher_remarks', array('type' => 'textarea')); ?>
            </td>
        </tr>
        <tr>
            <th><?php echo __('Check Date'); ?></th>
            <td>
                <?php echo $this->Form->input('check_date', array('class' => 'datepicker')); ?>
            </td>
        </tr>
        <tr>
            <th><?php echo __('Publisher Policy Uri'); ?></th>
            <td>
                <?php echo $this->Form->input('publisher_policy_uri'); ?>
            </td>
        </tr>
        <tr>
            <th><?php echo __('Uri'); ?></th>
            <td>
                <?php echo $this->Form->input('uri'); ?>
            </td>
        </tr>
    </tbody>
</table>