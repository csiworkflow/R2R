<div>
    <h2>
        <?php echo __('List %s', __('ArticleHistory'));?>
        <?php $md = 'article_histories_index'; ?>
        <a href="#help-modal-<?php echo $md; ?>" role="button" class="btn-help" data-toggle="modal"><?php echo $this->Html->image('help.png'); ?></a>
    </h2>
    <?php echo $this->element('help_modal', array('md' => $md)); ?>

    <div class="alert">
        このページは案件履歴です。現時点の案件情報と異なる可能性がありますので注意してください。
    </div>

    <p>
        <?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
    </p>

    <table class="table table-striped table-bordered table-condensed">
        <tr>
            <th><?php echo $this->Paginator->sort('article_id', __('Article Id'));?></th>
            <th><?php echo $this->Paginator->sort('title');?></th>
            <th><?php echo $this->Paginator->sort('author_name');?></th>
            <th><?php echo $this->Paginator->sort('author_status_id', __('AuthorStatus'));?></th>
            <th><?php echo $this->Paginator->sort('publisher_status_id', __('PublisherStatus'));?></th>
            <th><?php echo $this->Paginator->sort('coauthor_status_id', __('CoauthorStatus'));?></th>
            <th><?php echo $this->Paginator->sort('author_policy');?></th>
            <th><?php echo $this->Paginator->sort('file_count', __('File Status'));?></th>
            <th><?php echo $this->Paginator->sort('publisher_embargo_period');?></th>
            <th><?php echo $this->Paginator->sort('user_id');?></th>
            <th><?php echo $this->Paginator->sort('modified');?></th>
        </tr>
        <?php foreach ($articleHistories as $articleHistory): ?>
        <tr>
            <td>
                <?php echo $articleHistory['ArticleHistory']['article_id']; ?>
            </td>
            <td>
                <?php echo $this->Html->link(mb_strimwidth($articleHistory['ArticleHistory']['title'], 0, 20, STRTRIM_SUFFIX), array('action' => 'view', $articleHistory['ArticleHistory']['id']), array('escape' => false)); ?>
            </td>
            <td><?php echo $articleHistory['ArticleHistory']['author_name']; ?></td>
            <td><?php echo $articleHistory['AuthorStatus']['name']; ?></td>
            <td><?php echo $articleHistory['PublisherStatus']['name']; ?></td>
            <td><?php echo $articleHistory['CoauthorStatus']['name']; ?></td>
            <td>
                <?php if ($articleHistory['ArticleHistory']['author_policy']): ?>
                <?php echo $author_policies[$articleHistory['ArticleHistory']['author_policy']]; ?>
                <?php else: ?>
                ---
                <?php endif; ?>
            </td>
            <td>
                <?php if ($articleHistory['ArticleHistory']['file_count'] > 0): ?>
                <?php echo __('Uploaded'); ?>
                <?php else:  ?>
                ---
                <?php endif; ?>
            </td>
            <td><?php echo $articleHistory['ArticleHistory']['publisher_embargo_period']; ?></td>
            <td>
                <?php if ($articleHistory['ArticleHistory']['user_id']): ?>
                <?php echo $articleHistory['User']['name']; ?>
                <?php else: ?>
                ---
                <?php endif; ?>
            </td>
            <td><?php echo $articleHistory['ArticleHistory']['modified']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php echo $this->Paginator->pagination(); ?>
</div>