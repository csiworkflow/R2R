<!-- Import Articles -->
<div id="modal-import-articles" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modal-import-articles-label" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="modal-import-articles-label"><?php echo __('Import Articles'); ?></h3>
    </div>
    <div class="modal-body">
        <?php foreach($import_plugins as $plugin): ?>
        <?php echo $this->element('menu', array(), array('plugin' => $plugin)); ?>
        <?php endforeach; ?>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Close'); ?></button>
    </div>
</div>