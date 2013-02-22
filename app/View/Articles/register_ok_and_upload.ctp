<div>
    <div>
        <?php echo d($contents['PageContent']['register_upload_header']); ?>
    </div>
    <?php echo $this->Form->create('Article', array(
      'class' => 'form-horizontal',
      'action' => 'register_ok_and_upload/' . $hash,
      'type' => 'file',
      'inputDefaults' => array('type' => 'text', 'label' => false, 'div' => false, 'divControls' => false)));?>
    <div>
        <?php echo $this->partial('article_info'); ?>
        <table class="table table-bordered table-condensed">
            <?php for($i = 1;$i <= 5; $i++): ?>
            <tr>
                <th>
                    <?php echo __('File') ?><?php echo $i; ?>
                </th>
                <td>
                    <?php echo $this->Label->link($article['Article']['file' . $i]); ?>
                    <?php echo $this->Form->input('file' . $i, array('type' => 'file')); ?>
                </td>
            </tr>
            <?php endfor; ?>
        </table>
    </div>
    <?php echo $this->Form->hidden('id'); ?>
    <?php echo $this->Form->submit(__('Upload'));?>
    <?php echo $this->Form->end();?>
    <div>
        <?php echo d($contents['PageContent']['register_upload_footer']); ?>
    </div>
</div>
