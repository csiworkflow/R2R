<div>
    <h2><?php  echo __('Journal');?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
            <?php echo $journal['Journal']['id']; ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Publisher'); ?></dt>
        <dd>
            <?php echo $journal['Journal']['publisher']; ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Journal Title') ?></dt>
        <dd>
            <?php echo $journal['Journal']['title']; ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Issn'); ?></dt>
        <dd>
            <?php echo $journal['Journal']['issn']; ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Ncid'); ?></dt>
        <dd>
            <?php echo $journal['Journal']['ncid']; ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Publisher Policy'); ?></dt>
        <dd>
            <?php if ($journal['Journal']['publisher_policy']): ?>
            <?php echo $policy_colors[$journal['Journal']['publisher_policy']]; ?>
            <?php else: ?>
            ---
            <?php endif; ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Policy Open Type Version'); ?></dt>
        <dd>
            <?php if (!empty($publisher_open_file_versions[$journal['Journal']['publisher_open_file_version']])): ?>
            <?php echo $publisher_open_file_versions[$journal['Journal']['publisher_open_file_version']]; ?>
            <?php else: ?>
            ---
            <?php endif; ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Publisher Open Condition'); ?></dt>
        <dd>
            <?php echo $journal['Journal']['publisher_open_condition']; ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Publisher Request Method'); ?></dt>
        <dd>
            <?php if (!empty($publisher_request_methods[$journal['Journal']['publisher_request_method']])): ?>
            <?php echo $publisher_request_methods[$journal['Journal']['publisher_request_method']]; ?>
            <?php else: ?>
            ---
            <?php endif; ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Publisher Contact Email'); ?></dt>
        <dd>
            <?php echo $journal['Journal']['publisher_contact_email']; ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Publisher Contact Zipcode'); ?></dt>
        <dd>
            <?php echo $journal['Journal']['publisher_contact_zipcode']; ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Publisher Contact Address'); ?></dt>
        <dd>
            <?php echo $journal['Journal']['publisher_contact_address']; ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Publisher Contact Tel No'); ?></dt>
        <dd>
            <?php echo $journal['Journal']['publisher_contact_tel_no']; ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Publisher Contact Fax No'); ?></dt>
        <dd>
            <?php echo $journal['Journal']['publisher_contact_fax_no']; ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Publisher Remarks'); ?></dt>
        <dd>
            <?php echo $journal['Journal']['publisher_remarks']; ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Check Date'); ?></dt>
        <dd>
            <?php echo $journal['Journal']['check_date']; ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Publisher Policy Uri'); ?></dt>
        <dd>
            <?php echo $journal['Journal']['publisher_policy_uri']; ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Uri'); ?></dt>
        <dd>
            <?php echo $journal['Journal']['uri']; ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd>
            <?php echo $journal['Journal']['created']; ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Modified'); ?></dt>
        <dd>
            <?php echo $journal['Journal']['modified']; ?>
            &nbsp;
        </dd>
    </dl>
</div>