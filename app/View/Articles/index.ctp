<div class="row-fluid">
    <div class="span9">
        <h2>
            <?php echo __('List %s', __('Article'));?>
            <?php $md = 'articles_index'; ?>
            <a href="#help-modal-<?php echo $md; ?>" role="button" class="btn-help" data-toggle="modal"><?php echo $this->Html->image('help.png'); ?></a>
        </h2>
        <?php echo $this->element('help_modal', array('md' => $md)); ?>
        <?php echo $this->Form->create('Article', array(
          'action' => 'index',
          'class' => 'form-search',
          'inputDefaults' => array('label' => false, 'div' => false))); ?>
        <?php echo $this->Form->input('keyword', array('type' => 'text', 'placeholder' => 'キーワード')); ?>
        <?php echo $this->Form->submit(__('Search'), array('div' => false, 'class' => 'btn btn-primary')); ?>
        <a id="btn-article-advanced-search" class="btn tooltip-target" href="#" rel="tooltip" data-original-title="<?php echo __('Advanced Search'); ?>"><?php echo $this->Html->image('advanced.png'); ?></a>
        <div id="article-advanced-search" class="well well-small well-white <?php echo ($hide) ? 'hide': ''; ?>">
        <div class="alert">
            ※
            ステータスの指定がない場合はOPEN系のステータスのみが表示されます
        </div>
        <table>
            <tr>
                <th>
                    <?php echo __('AuthorStatus'); ?>
                </th>
                <td>
                    <?php echo $this->Form->input('author_status_id', array('type' => 'select', 'options' => $author_statuses, 'empty' => true)); ?>
                </td>
            </tr>
            <tr>
                <th>
                    <?php echo __('PublisherStatus'); ?>
                </th>
                <td>
                    <?php echo $this->Form->input('publisher_status_id', array('type' => 'select', 'options' => $publisher_statuses, 'empty' => true)); ?>
                </td>
            </tr>
            <tr>
                <th>
                    <?php echo __('CoauthorStatus'); ?>
                </th>
                <td>
                    <?php echo $this->Form->input('coauthor_status_id', array('type' => 'select', 'options' => $coauthor_statuses, 'empty' => true)); ?>
                </td>
            </tr>
            <tr>
                <th>
                    <?php echo __('Author Policy'); ?>
                </th>
                <td>
                    <?php echo $this->Form->input('author_policy', array('type' => 'select', 'options' => $author_policies, 'empty' => true)); ?>
                </td>
            </tr>
            <tr>
                <th>
                    <?php echo __('File Status'); ?>
                </th>
                <td>
                    <?php echo $this->Form->input('file_status', array('type' => 'select', 'options' => array(false => __('No File'), true => __('Uploaded')), 'empty' => true)); ?>
                </td>
            </tr>
            <tr>
                <th>
                    <?php echo __('Publisher Embargo Period'); ?>
                </th>
                <td>
                    <?php echo $this->Form->input('publisher_embargo_period_complete', array('type' => 'select', 'options' => array(true => __('Period Complete')), 'empty' => true)); ?>
                </td>
            </tr>
        </table></div>
        <?php echo $this->Form->end(); ?>

        <?php foreach($bulk_plugins as $plugin): ?>
        <?php echo $this->element('menu', array(), array('plugin' => $plugin)); ?>
        <?php endforeach; ?>
    </div>
    <div class="span3 well well-white">
        <h4><?php echo __('Status Type Open') ?>の案件数</h4>
        <table id="open-article-count" class="table table-bordered table-condensed">
            <tr>
                <th>
                    <?php echo __('Open Articles'); ?>
                </th>
                <td>
                    <?php echo $this->Html->link($articlesOpenCount, array('controller' => 'articles', 'action' => 'index')); ?>
                    件
                </td>
            </tr>
            <tr>
                <th>
                    <?php echo __('Open And Author Policy Saved') ?>
                </th>
                <td>
                    <?php echo $this->Html->link($articlesAuthorPolicyCount, array('controller' => 'articles', 'action' => 'index', 'author_policy' => ARTICLE_AUTHOR_POLICY_NOT_NULL)); ?>
                    件
                </td>
            </tr>
            <tr>
                <th>
                    <?php echo __('Open And File Uploaded') ?>
                </th>
                <td>
                    <?php echo $this->Html->link($articlesFileUploadedCount, array('controller' => 'articles', 'action' => 'index', 'file_status' => true)); ?>
                    件
                </td>
            </tr>
            <tr>
                <th>
                    <?php echo __('Open And Embargo Complete'); ?>
                </th>
                <td>
                    <?php echo $this->Html->link($articlesEmbargoCompleteCount, array('controller' => 'articles', 'action' => 'index', 'publisher_embargo_period_complete' => true)); ?>
                    件
                </td>
            </tr>
        </table>
    </div>
</div>

<div>
    <p>
        <?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
    </p>
    <table class="table table-striped table-bordered table-condensed">
        <tr>
            <th><?php echo $this->Paginator->sort('id');?></th>
            <th><?php echo $this->Paginator->sort('title');?></th>
            <th><?php echo $this->Paginator->sort('author_name');?></th>
            <th><?php echo $this->Paginator->sort('author_status_id', __('AuthorStatus'));?></th>
            <th><?php echo $this->Paginator->sort('publisher_status_id', __('PublisherStatus'));?></th>
            <th><?php echo $this->Paginator->sort('coauthor_status_id', __('CoauthorStatus'));?></th>
            <th><?php echo $this->Paginator->sort('publisher_open_file_version');?></th>
            <th><?php echo $this->Paginator->sort('author_policy');?></th>
            <th>
                <?php echo $this->Paginator->sort('file_count', __('File Status'));?>
            </th>
            <th><?php echo $this->Paginator->sort('publisher_embargo_period');?></th>
            <th><?php echo $this->Paginator->sort('modified');?></th>
            <th class="actions"><?php echo __('Actions');?></th>
        </tr>
        <?php foreach ($articles as $article): ?>
        <tr>
            <td><?php echo $article['Article']['id']; ?></td>
            <td>
                <?php echo $this->Html->link(mb_strimwidth($article['Article']['title'], 0, 20, STRTRIM_SUFFIX), array('action' => 'view', $article['Article']['id']), array('escape' => false)); ?>
            </td>
            <td><?php echo $article['Article']['author_name']; ?></td>
            <td><?php echo $article['AuthorStatus']['name']; ?></td>
            <td><?php echo $article['PublisherStatus']['name']; ?></td>
            <td><?php echo $article['CoauthorStatus']['name']; ?></td>
            <td>
                <?php if ($article['Article']['publisher_open_file_version']): ?>
                <?php echo $publisher_open_file_versions[$article['Article']['publisher_open_file_version']]; ?>
                <?php else: ?>
                ---
                <?php endif; ?>
            </td>
            <td>
                <?php if ($article['Article']['author_policy']): ?>
                <?php echo $author_policies[$article['Article']['author_policy']]; ?>
                <?php else: ?>
                ---
                <?php endif; ?>
            </td>
            <td>
                <?php if ($article['Article']['file_count'] > 0): ?>
                <?php echo __('Uploaded'); ?>
                <div>
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                    <?php if ($this->Label->url($article['Article']['file' . $i])): ?>
                    <a class="tooltip-target" rel="tooltip" data-original-title="<?php echo $article['Article']['file' . $i]['file_name']; ?>" target="_blank" href="<?php echo $this->Label->url($article['Article']['file' . $i]); ?>">
                    <?php echo $this->Html->image('download.png', array()); ?></a>
                    <?php endif; ?>
                    <?php endfor; ?>
                </div>
                <?php else:  ?>
                ---
                <?php endif; ?>
            </td>
            <td><?php echo $article['Article']['publisher_embargo_period']; ?></td>
            <td><?php echo $article['Article']['modified']; ?></td>
            <td class="actions">
                <a href="#article-modal-<?php echo $article['Article']['id']; ?>" role="button" class="btn" data-toggle="modal"><?php echo __('Action'); ?></a>
                <div id="article-modal-<?php echo $article['Article']['id']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="article-modal-label-<?php echo $article['Article']['id']; ?>" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="article-modal-label-<?php echo $article['Article']['id']; ?>"><?php echo __('Action'); ?></h3>
                </div>
                <div class="modal-body">
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $article['Article']['id']), array('class' => 'btn')); ?>
                    <?php echo $this->Html->link(__('Upload Files'), array('action' => 'upload', $article['Article']['id']), array('class' => 'btn')); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $article['Article']['id']), array('class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $article['Article']['title'])); ?>
                    <hr />
                    <h4><?php echo __('DocumentTemplate'); ?></h4>
                    <ul>
                        <?php foreach($templates as $id => $template): ?>
                        <li><?php echo $this->Html->link($template, array('controller' => 'document_templates', 'action' => 'clip', $id, $article['Article']['id']), array('target' => '_blank')); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <hr />
                    <h4><?php echo __('Aurhor Register URL'); ?></h4>
                    <?php echo $this->Html->link(__('Link'), array('controller' => 'articles', 'action' => 'register', $article['Article']['hash']), array('target' => '_blank')); ?>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                </div></div>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php echo $this->Paginator->pagination(); ?>
</div>