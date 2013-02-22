<table class="table table-bordered table-condensed">
    <tr>
        <th>
            Title
        </th>
        <td>
            <?php echo $article['Article']['title']; ?>
        </td>
    </tr>
    <tr>
        <th>
            Authors
        </th>
        <td>
            <?php echo $article['Article']['contributor_author']; ?>
        </td>
    </tr>
    <tr>
        <th>
            Source Title
        </th>
        <td>
            <?php echo $article['Article']['identifier_title']; ?>
        </td>
    </tr>
    <tr>
        <th>
            Volume
        </th>
        <td>
            <?php echo $article['Article']['identifier_volume']; ?>
        </td>
    </tr>
    <tr>
        <th>
            Issue
        </th>
        <td>
            <?php echo $article['Article']['identifier_number']; ?>
        </td>
    </tr>
    <tr>
        <th>
            File Version
        </th>
        <td>
            <?php if ($article['Article']['publisher_open_file_version']): ?>
            <?php echo $publisher_open_file_versions[$article['Article']['publisher_open_file_version']]; ?>
            <?php else: ?>
            ---
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <th>
            Status
        </th>
        <td>
            <?php if ($article['Article']['file_count'] > 0): ?>
            <?php echo __('Uploaded'); ?>
            <?php else:  ?>
            <?php echo __('No File'); ?>
            <?php endif; ?>
        </td>
    </tr>
</table>
