<div>
    <h2><?php  echo __('Journal');?></h2>
    <table class="table table-bordered table-condensed article-table">
        <tbody>
            <?php if($this->action === 'view'): ?>
            <tr>
                <th>
                    <?php echo __('Id'); ?>
                </th>
                <td>
                    <?php echo $journal['Journal']['id']; ?>
                </td>
            </tr>
            <?php endif; ?>
            <tr>
                <th><?php echo __('Publisher'); ?></th>
                <td>
                    <?php echo $journal['Journal']['publisher']; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo __('Journal Title') ?></th>
                <td>
                    <?php echo $journal['Journal']['title']; ?>

                </td>
            </tr>
            <tr>
                <th><?php echo __('Issn'); ?></th>
                <td>
                    <?php echo $journal['Journal']['issn']; ?>

                </td>
            </tr>
            <tr>
                <th><?php echo __('Ncid'); ?></th>
                <td>
                    <?php echo $journal['Journal']['ncid']; ?>

                </td>
            </tr>
            <tr>
                <th><?php echo __('Publisher Policy'); ?></th>
                <td>
                    <?php if ($journal['Journal']['publisher_policy']): ?>
                    <?php echo $policy_colors[$journal['Journal']['publisher_policy']]; ?>
                    <?php else: ?>
                    ---
                    <?php endif; ?>

                </td>
            </tr>
            <tr>
                <th><?php echo __('Policy Open Type Version'); ?></th>
                <td>
                    <?php if (!empty($publisher_open_file_versions[$journal['Journal']['publisher_open_file_version']])): ?>
                    <?php echo $publisher_open_file_versions[$journal['Journal']['publisher_open_file_version']]; ?>
                    <?php else: ?>
                    ---
                    <?php endif; ?>

                </td>
            </tr>
            <tr>
                <th><?php echo __('Publisher Open Condition'); ?></th>
                <td>
                    <?php echo $journal['Journal']['publisher_open_condition']; ?>

                </td>
            </tr>
            <tr>
                <th><?php echo __('Publisher Request Method'); ?></th>
                <td>
                    <?php if (!empty($publisher_request_methods[$journal['Journal']['publisher_request_method']])): ?>
                    <?php echo $publisher_request_methods[$journal['Journal']['publisher_request_method']]; ?>
                    <?php else: ?>
                    ---
                    <?php endif; ?>

                </td>
            </tr>
            <tr>
                <th><?php echo __('Publisher Contact Email'); ?></th>
                <td>
                    <?php echo $journal['Journal']['publisher_contact_email']; ?>

                </td>
            </tr>
            <tr>
                <th><?php echo __('Publisher Contact Zipcode'); ?></th>
                <td>
                    <?php echo $journal['Journal']['publisher_contact_zipcode']; ?>

                </td>
            </tr>
            <tr>
                <th><?php echo __('Publisher Contact Address'); ?></th>
                <td>
                    <?php echo $journal['Journal']['publisher_contact_address']; ?>

                </td>
            </tr>
            <tr>
                <th><?php echo __('Publisher Contact Tel No'); ?></th>
                <td>
                    <?php echo $journal['Journal']['publisher_contact_tel_no']; ?>

                </td>
            </tr>
            <tr>
                <th><?php echo __('Publisher Contact Fax No'); ?></th>
                <td>
                    <?php echo $journal['Journal']['publisher_contact_fax_no']; ?>

                </td>
            </tr>
            <tr>
                <th><?php echo __('Publisher Remarks'); ?></th>
                <td>
                    <?php echo $journal['Journal']['publisher_remarks']; ?>

                </td>
            </tr>
            <tr>
                <th><?php echo __('Check Date'); ?></th>
                <td>
                    <?php echo $journal['Journal']['check_date']; ?>

                </td>
            </tr>
            <tr>
                <th><?php echo __('Publisher Policy Uri'); ?></th>
                <td>
                    <?php echo $journal['Journal']['publisher_policy_uri']; ?>

                </td>
            </tr>
            <tr>
                <th><?php echo __('Uri'); ?></th>
                <td>
                    <?php echo $journal['Journal']['uri']; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo __('Created'); ?></th>
                <td>
                    <?php echo $journal['Journal']['created']; ?>
                </td>
            </tr>
            <tr>
                <th><?php echo __('Modified'); ?></th>
                <td>
                    <?php echo $journal['Journal']['modified']; ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>