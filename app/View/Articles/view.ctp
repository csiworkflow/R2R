<div class="action-menu">
    <div class="action-menu-inner">
        <?php echo $this->Html->link(__('Edit'), array('controller' => 'articles', 'action' => 'edit', $article['Article']['id']), array('class' => 'btn')); ?>
        <a href="#article-modal-document-template" role="button" class="btn" data-toggle="modal"><?php echo __('DocumentTemplate'); ?></a>
        <?php echo $this->Html->link(__('ArticleHistory'), array('controller' => 'article_histories', 'action' => 'index', 'article_id' => $article['Article']['id']), array('class' => 'btn')); ?>
    </div>
</div>
<div>
    <h2><?php  echo __('Article');?></h2>

    <table class="table table-bordered table-condensed articleHistory-table">
        <tbody>
            <tr>
                <th>
                    <?php echo __('Article Id') ?>
                </th>
                <td>
                    <?php echo $article['Article']['id']; ?>
                </td>
                <th>
                    <?php echo __('Modified') ?>
                </th>
                <td>
                    <?php echo $article['Article']['modified']; ?>
                </td>
                <th>
                    <?php echo __('Created') ?>
                </th>
                <td>
                    <?php echo $article['Article']['created']; ?>
                </td>
            </tr>
        </tbody>
    </table>


    <?php echo $this->partial('form'); ?>
</div>

<div id="article-modal-document-template" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="article-modal-label-document-template" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="article-modal-label-document-template"><?php echo __('DocumentTemplate'); ?></h3>
    </div>
    <div class="modal-body">
        <ul>
            <?php foreach($templates as $id => $template): ?>
            <li><?php echo $this->Html->link($template, array('controller' => 'document_templates', 'action' => 'clip', $id, $article['Article']['id']), array('target' => '_blank')); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
</div></div>