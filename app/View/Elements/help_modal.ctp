<div id="help-modal-<?php echo $md; ?>" class="modal hide fade help-modal" tabindex="-1" role="dialog" aria-labelledby="help-modal-<?php echo $md; ?>-label" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="help-modal-<?php echo $md; ?>-label"><?php echo empty($title) ? __('Help') : $title; ?></h3>
    </div>
    <div class="modal-body help-modal-body">
        <?php echo $this->Markdown->loadFile($md, $this->viewVars); ?>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo __('Close'); ?></button>
    </div>
</div>