<h2><?php echo __('Upload Files'); ?></h2>
<div>
    <?php echo $this->Form->create('Article', array(
      'class' => 'form-horizontal',
      'type' => 'file',
      'inputDefaults' => array('type' => 'text', 'label' => false, 'div' => false, 'divControls' => false)));?>
    <table class="table table-bordered table-condensed">
        <?php for($i = 1;$i <= 5; $i++): ?>
        <tr>
            <th>
                <?php echo __('File') ?><?php echo $i; ?>
            </th>
            <td>
                <?php echo $this->Label->link($article['Article']['file' . $i]); ?>
                <?php echo $this->Form->input('file' . $i, array('type' => 'file')); ?>
                <?php if ($this->Label->link($this->data['Article']['file' . $i])): ?>
                <?php echo $this->Form->input('delete_file' . $i, array('type' => 'checkbox', 'div' => false)); ?><?php echo __('Delete File'); ?>
                <?php endif; ?>
            </td>
        </tr>
        <?php endfor; ?>
    </table>
    <?php echo $this->Form->hidden('id'); ?>
    <?php echo $this->Form->submit(__('Upload'));?>
    <?php echo $this->Form->end();?>
</div>