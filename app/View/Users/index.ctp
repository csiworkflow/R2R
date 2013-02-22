<div>
    <h2><?php echo __('List %s', __('User'));?></h2>

    <p>
        <?php
          echo $this->Paginator->counter(array(
          'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
          ));
        ?>
    </p>
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('name');?></th>
                <th><?php echo $this->Paginator->sort('username');?></th>
                <th><?php echo $this->Paginator->sort('modified');?></th>
                <th class="actions"><?php echo __('Actions');?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user):?>
            <tr>
                <td>
                    <?php echo $user['User']['name']; ?>
                </td>
                <td>
                    <?php echo $user['User']['username']; ?>
                </td>
                <td>
                    <?php echo $user['User']['modified']; ?>
                </td>
                <td class="actions">
                    <div class="btn-group">
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id']), array('class' => 'btn')); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $user['User']['name'])); ?>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php echo $this->Paginator->pagination(); ?>
</div>