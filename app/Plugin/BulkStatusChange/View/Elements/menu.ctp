<div class="well well-small well-gray">
    <h3 class="bulk-plugin-title"><?php echo __d('bulk_status_change', 'Bulk Status Change'); ?></h3>
    <?php echo $this->Form->create('Article', array(
      'url' => array('controller' => 'bulk_status_changes', 'action' => 'change', 'plugin' => 'bulk_status_change'),
      'class' => 'form-search',
      'inputDefaults' => array('label' => false, 'div' => false))); ?>
    <table>
        <tr>
            <th>
                <?php echo __('AuthorStatus'); ?>
            </th>
            <td>
                <?php echo $this->Form->input('change_author_status_id', array('type' => 'select', 'options' => $author_statuses, 'empty' => true, 'class' => 'input-medium')); ?>
            </td>
            <th>
                <?php echo __('PublisherStatus'); ?>
            </th>
            <td>
                <?php echo $this->Form->input('change_publisher_status_id', array('type' => 'select', 'options' => $publisher_statuses, 'empty' => true, 'class' => 'input-medium')); ?>
            </td>
            <th>
                <?php echo __('CoauthorStatus'); ?>
            </th>
            <td>
                <?php echo $this->Form->input('change_coauthor_status_id', array('type' => 'select', 'options' => $coauthor_statuses, 'empty' => true, 'class' => 'input-medium')); ?>
            </td>
        </tr>
    </table>
    <?php echo $this->Form->input('keyword', array('type' => 'hidden')); ?>
    <?php echo $this->Form->input('author_status_id', array('type' => 'hidden')); ?>
    <?php echo $this->Form->input('publisher_status_id', array('type' => 'hidden')); ?>
    <?php echo $this->Form->input('coauthor_status_id', array('type' => 'hidden')); ?>
    <?php echo $this->Form->input('author_policy', array('type' => 'hidden')); ?>
    <?php echo $this->Form->input('file_status', array('type' => 'hidden')); ?>
    <?php echo $this->Form->input('publisher_embargo_period_complete', array('type' => 'hidden')); ?>
    <?php echo $this->Form->submit(__('Change')); ?>
    <?php echo $this->Form->end(); ?>
</div>
