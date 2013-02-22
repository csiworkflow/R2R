<div>
    <div>
        <?php echo d($contents['PageContent']['register_header']); ?>
    </div>
    <div>
        <?php echo $this->partial('article_info'); ?>
    </div>
    <div id="register-buttons" class="btn-group">
        <?php if ($contents['PageContent']['btn_display_type'] !== PAGE_CONTENT_BTN_DISPLAY_TYPE_OK_AND_NG): ?>
        <?php echo $this->Html->link($contents['PageContent']['btn_label_ok_and_upload'], array('controller' => 'articles', 'action' => 'register_ok_and_upload', $hash), array('class' => 'btn btn-primary')); ?>
        <?php endif; ?>
        <?php if ($contents['PageContent']['btn_display_type'] !== PAGE_CONTENT_BTN_DISPLAY_TYPE_UPLOAD_AND_NG): ?>
        <?php echo $this->Html->link($contents['PageContent']['btn_label_ok'], array('controller' => 'articles', 'action' => 'register_ok_complete', $hash), array('class' => 'btn btn-info')); ?>
        <?php endif; ?>
        <?php echo $this->Html->link($contents['PageContent']['btn_label_ng'], array('controller' => 'articles', 'action' => 'register_ng_complete', $hash), array('class' => 'btn btn-warning')); ?>

    </div>
    <div>
        <?php echo d($contents['PageContent']['register_footer']); ?>
    </div>
</div>
