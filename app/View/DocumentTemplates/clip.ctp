<h2><?php echo __('Document Template Clip'); ?></h2>

<table class="table table-bordered table-condensed">
    <tr>
        <th>
            <?php echo __('Template Name'); ?>
        </th>
        <td>
            <?php echo $documentTemplate['DocumentTemplate']['name']; ?>
        </td>
    </tr>
    <tr>
        <th>
            <?php echo __('Title') ?>
        </th>
        <td>
            <?php echo $article['Article']['title']; ?>
        </td>
    </tr>
    <tr>
        <th>
            <?php echo __('Author Name'); ?>
        </th>
        <td>
            <?php echo $article['Article']['author_name']; ?>
        </td>
    </tr>
    <tr>
        <th>
            <?php echo __('Author Contact Info'); ?>
        </th>
        <td>
            <?php echo $article['Article']['author_contact_info']; ?>
        </td>
    </tr>
    <tr>
        <th>
            <?php echo __('Publisher Contact Info'); ?>
        </th>
        <td>
            <?php echo $article['Article']['publisher_contact_info']; ?>
        </td>
    </tr>
    <tr>
        <th>
            <?php echo __('Publisher Open File Version') ?>
        </th>
        <td>
            <?php if ($article['Article']['publisher_open_file_version']): ?>
            <?php echo $publisher_open_file_versions[$article['Article']['publisher_open_file_version']]; ?>
            <?php else: ?>
            ---
            <?php endif; ?>
        </td>
    </tr>
</table>

<pre><?php echo $documentTemplate['DocumentTemplate']['body_top']; ?>


Title        : <?php echo $article['Article']['title']; ?>

Authors      : <?php echo $article['Article']['contributor_author']; ?>

Source Title : <?php echo $article['Article']['identifier_title']; ?>

Volume       : <?php echo $article['Article']['identifier_volume']; ?>

Issue        : <?php echo $article['Article']['identifier_number']; ?>

File Version : <?php if ($article['Article']['publisher_open_file_version']): ?><?php echo $publisher_open_file_versions[$article['Article']['publisher_open_file_version']]; ?><?php else: ?>---<?php endif; ?>


<?php if ($documentTemplate['DocumentTemplate']['author_url_flg']): ?>
論文登録許諾 (Register Article OK/NG)
<?php echo $this->Html->url(array('controller' => 'articles', 'action' => 'register', $article['Article']['hash']), true); ?>
<?php endif; ?>


<?php echo $documentTemplate['DocumentTemplate']['body_bottom']; ?></pre>