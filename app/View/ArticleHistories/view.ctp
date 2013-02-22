<div>
    <h2><?php  echo __('ArticleHistory');?></h2>

    <div class="alert">
        このページは案件履歴です。現時点の案件情報と異なる可能性がありますので注意してください。
    </div>

    <table class="table table-bordered table-condensed articleHistory-table">
        <tbody>
            <tr>
                <th>
                    <?php echo __('Article Id') ?>
                </th>
                <td>
                    <?php echo $this->Html->link($articleHistory['ArticleHistory']['article_id'], array('controller' => 'articles', 'action' => 'view', $articleHistory['ArticleHistory']['article_id'])); ?>
                </td>
                <th>
                    <?php echo __('Modified') ?>
                </th>
                <td>
                    <?php echo $articleHistory['ArticleHistory']['modified']; ?>
                </td>
                <th>
                    <?php echo __('User') ?>
                </th>
                <td>
                    <?php if ($articleHistory['ArticleHistory']['user_id']): ?>
                    <?php echo $articleHistory['User']['name']; ?>
                    <?php else: ?>
                    ---
                    <?php endif; ?>
                </td>
            </tr>
        </tbody>
    </table>

    <?php echo $this->partial('form'); ?>
</div>