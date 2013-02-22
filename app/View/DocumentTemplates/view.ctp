<div>
    <h2><?php  echo __('DocumentTemplate');?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
            <?php echo h($documentTemplate['DocumentTemplate']['id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Template Name'); ?></dt>
        <dd>
            <?php echo h($documentTemplate['DocumentTemplate']['name']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Body'); ?></dt>
        <dd>
<pre><?php echo $documentTemplate['DocumentTemplate']['body_top']; ?>


<?php if ($documentTemplate['DocumentTemplate']['author_url_flg']): ?>http://<?php endif; ?>


<?php echo $documentTemplate['DocumentTemplate']['body_bottom']; ?></pre>
        </dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd>
            <?php echo h($documentTemplate['DocumentTemplate']['created']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Modified'); ?></dt>
        <dd>
            <?php echo h($documentTemplate['DocumentTemplate']['modified']); ?>
            &nbsp;
        </dd>
    </dl>
</div>