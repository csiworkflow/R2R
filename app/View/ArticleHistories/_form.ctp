<table class="table table-bordered table-condensed articleHistory-table">
    <tbody>
        <?php $fields = array(
          'title',
          'title_alternative',
          'contributor_author',
          'creator_alternative',
          'creator_transcription',
          'contributor_affiliation',
          'date_issued',
          'identifier_citation',
          'identifier_title',
          'identifier_volume',
          'identifier_number',
          'identifier_spage',
          'identifier_epage',
          'identifier_isbn',
          'identifier_issn',
          'description_abstract',
          'subject',
          'description',
          'description_tableofcontents',
          'identifier_doi',
          'rights',
          'rights_uri',
          'language_iso',
          'language_iso639_2',
          'publisher',
          'publisher_alternative',
          'relation_uri',
          'type_nii',
          'type',
          'peerreviewed',
          'textversion',
          'publicationstatus',
          'identifier_ncid',
          'identifier_pmid',
          'local',
          'source',
          ); ?>
        <?php foreach($fields as $fieldName): ?>
        <tr>
            <th>
                <?php echo __(Inflector::humanize($fieldName)); ?>
            </th>
            <td>
                <?php if (in_array($fieldName, array(
                  'language_iso',
                  'language_iso639_2',
                  'publicationstatus',
                  'peerreviewed',
                  'type_nii',
                  'textversion',
                  ))): ?>
                <?php // select ?>
                <?php if($this->action === 'view'): ?>
                <?php if(empty($articleHistory['ArticleHistory'][$fieldName])): ?>
                ---
                <?php else: ?>
                <?php echo ${Inflector::pluralize($fieldName)}[$articleHistory['ArticleHistory'][$fieldName]]; ?>
                <?php endif;  ?>
                <?php else: ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'select', 'options' => ${Inflector::pluralize($fieldName)}, 'empty' => true, 'class' => '')); ?>
                <?php endif;  ?>

                <?php elseif(in_array($fieldName, array(
                  'description_abstract',
                  ))): ?>
                <?php // textarea ?>
                <?php if($this->action === 'view'): ?>
                <?php echo nl2br($articleHistory['ArticleHistory'][$fieldName]); ?>
                <?php else: ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'textarea', 'class' => 'input-xxlarge')); ?>
                <?php endif; ?>
                <?php elseif(in_array($fieldName, array('id'))): ?>
                <?php // hidden ?>
                <?php echo $this->Form->value($fieldName); ?>
                <?php else: ?>
                <?php if($this->action === 'view'): ?>
                <?php echo $articleHistory['ArticleHistory'][$fieldName]; ?>
                <?php else: ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'text', 'class' => 'input-xxlarge')); ?>
                <?php endif; ?>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h3><?php echo __('Option'); ?></h3>

<table class="table table-bordered table-condensed articleHistory-table">
    <tbody>
        <?php $fields = array(
          'publisher_policy',
          'publisher_policy_type',
          'publisher_open_condition',
          'publisher_source_uri',
          'publisher_open_file_version',
          'publisher_embargo_period',
          'publisher_embargo_close_action',
          'publisher_policy_uri',
          'publisher_other',
          'publisher_source',
          'publisher_request_method',
          'publisher_contact_info',
          'publisher_remarks',
          );?>
        <?php foreach($fields as $fieldName): ?>
        <tr>
            <th>
                <?php echo __(Inflector::humanize($fieldName)); ?>
            </th>
            <td>
                <?php if (in_array($fieldName, array(
                  'publisher_policy',
                  'publisher_request_method',
                  'publisher_open_file_version',
                  ))): ?>
                <?php // select ?>
                <?php if($this->action === 'view'): ?>
                <?php if(empty($articleHistory['ArticleHistory'][$fieldName])): ?>
                ---
                <?php else: ?>
                <?php echo ${Inflector::pluralize($fieldName)}[$articleHistory['ArticleHistory'][$fieldName]]; ?>
                <?php endif;  ?>
                <?php else: ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'select', 'options' => ${Inflector::pluralize($fieldName)}, 'empty' => true, 'class' => '')); ?>
                <?php endif;  ?>
                <?php elseif(in_array($fieldName, array(
                  'publisher_policy_type',
                  'publisher_open_condition',
                  'publisher_other',
                  'publisher_remarks',
                  ))): ?>
                <?php // textarea ?>
                <?php if($this->action === 'view'): ?>
                <?php echo nl2br($articleHistory['ArticleHistory'][$fieldName]); ?>
                <?php else: ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'textarea', 'class' => 'input-xxlarge')); ?>
                <?php endif; ?>
                <?php elseif(in_array($fieldName, array('id'))): ?>
                <?php // hidden ?>
                <?php echo $this->Form->value($fieldName); ?>
                <?php elseif(in_array($fieldName, array('publisher_embargo_period'))): ?>
                <?php // datepicker ?>
                <?php if($this->action === 'view'): ?>
                <?php echo $articleHistory['ArticleHistory'][$fieldName]; ?>
                <?php else: ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'text', 'class' => 'datepicker')); ?>
                <?php endif; ?>
                <?php else: ?>
                <?php if($this->action === 'view'): ?>
                <?php echo $articleHistory['ArticleHistory'][$fieldName]; ?>
                <?php else: ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'text', 'class' => 'input-xxlarge')); ?>
                <?php endif; ?>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<table class="table table-bordered table-condensed articleHistory-table">
    <tbody>
        <?php $fields = array(
          'author_name',
          'author_id',
          'author_policy',
          'author_comment',
          'author_request_method',
          'author_contact_info',
          'author_coauthor_flg',
          'author_remarks',
          );?>
        <?php foreach($fields as $fieldName): ?>
        <tr>
            <th>
                <?php echo __(Inflector::humanize($fieldName)); ?>
            </th>
            <td>
                <?php if (in_array($fieldName, array(
                  'author_policy',
                  'author_request_method',
                  ))): ?>
                <?php // select ?>
                <?php if($this->action === 'view'): ?>
                <?php if(empty($articleHistory['ArticleHistory'][$fieldName])): ?>
                ---
                <?php else: ?>
                <?php echo ${Inflector::pluralize($fieldName)}[$articleHistory['ArticleHistory'][$fieldName]]; ?>
                <?php endif;  ?>
                <?php else: ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'select', 'options' => ${Inflector::pluralize($fieldName)}, 'empty' => true, 'class' => '')); ?>
                <?php endif;  ?>
                <?php elseif(in_array($fieldName, array(
                  'author_comment',
                  'author_remarks',
                  ))): ?>
                <?php // textarea ?>
                <?php if($this->action === 'view'): ?>
                <?php echo nl2br($articleHistory['ArticleHistory'][$fieldName]); ?>
                <?php else: ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'textarea', 'class' => 'input-xxlarge')); ?>
                <?php endif; ?>
                <?php elseif(in_array($fieldName, array('id'))): ?>
                <?php // hidden ?>
                <?php echo $this->Form->value($fieldName); ?>
                <?php else: ?>
                <?php if($this->action === 'view'): ?>
                <?php echo $articleHistory['ArticleHistory'][$fieldName]; ?>
                <?php else: ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'text', 'class' => 'input-xxlarge')); ?>
                <?php endif; ?>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<table class="table table-bordered table-condensed articleHistory-table">
    <tbody>
        <?php for($i = 1; $i <= 5; $i++): ?>
        <?php $fields = array(
          'coauthor_name' . $i,
          'coauthor_id' . $i,
          'coauthor_policy' . $i,
          'coauthor_request_method' . $i,
          'coauthor_contact_info' . $i,
          'coauthor_remarks' . $i,
          );?>
        <?php foreach($fields as $fieldName): ?>
        <tr>
            <th>
                <?php echo __(Inflector::humanize(preg_replace('/[1-5]$/', '', $fieldName)) . ' %s', $i); ?>
            </th>
            <td>
                <?php if (in_array($fieldName, array(
                  'coauthor_policy' . $i,
                  'coauthor_request_method' . $i,
                  ))): ?>
                <?php // select ?>
                <?php if($this->action === 'view'): ?>
                <?php if(empty($articleHistory['ArticleHistory'][$fieldName])): ?>
                ---
                <?php else: ?>
                <?php echo ${Inflector::pluralize($fieldName)}[$articleHistory['ArticleHistory'][$fieldName]]; ?>
                <?php endif;  ?>
                <?php else: ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'select', 'options' => ${Inflector::pluralize(preg_replace('/[1-5]$/', '', $fieldName))}, 'empty' => true, 'class' => '')); ?>
                <?php endif;  ?>
                <?php elseif(in_array($fieldName, array(
                  'coauthor_remarks' . $i,
                  ))): ?>
                <?php // textarea ?>
                <?php if($this->action === 'view'): ?>
                <?php echo nl2br($articleHistory['ArticleHistory'][$fieldName]); ?>
                <?php else: ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'textarea', 'class' => 'input-xxlarge')); ?>
                <?php endif; ?>
                <?php elseif(in_array($fieldName, array('id'))): ?>
                <?php // hidden ?>
                <?php echo $this->Form->value($fieldName); ?>
                <?php else: ?>
                <?php if($this->action === 'view'): ?>
                <?php echo $articleHistory['ArticleHistory'][$fieldName]; ?>
                <?php else: ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'text', 'class' => 'input-xxlarge')); ?>
                <?php endif; ?>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php endfor; ?>
    </tbody>
</table>

<h3><?php echo __('File Status'); ?></h3>
<table class="table table-bordered table-condensed">
    <tr>
        <th>
            <?php echo __('File Status'); ?>
        </th>
        <td>
            <?php echo $articleHistory['ArticleHistory']['file_count']; ?>件
        </td>
    </tr>
</table>

<h3><?php echo __('Status'); ?></h3>

<table class="table table-bordered table-condensed">
    <thead>
        <th>
            <?php echo __('AuthorStatus'); ?>
        </th>
        <th>
            <?php echo __('PublisherStatus'); ?>
        </th>
        <th>
            <?php echo __('CoauthorStatus'); ?>
        </th>
    </thead>
    <tbody>
        <td>
            <?php if($this->action === 'view'): ?>
            <?php echo $articleHistory['AuthorStatus']['name']; ?>
            <?php else: ?>
            <?php echo $this->Form->input('author_status_id', array('type' => 'select')); ?>
            <?php endif; ?>
        </td>
        <td>
            <?php if($this->action === 'view'): ?>
            <?php echo $articleHistory['PublisherStatus']['name']; ?>
            <?php else: ?>
            <?php echo $this->Form->input('publisher_status_id', array('type' => 'select')); ?>
            <?php endif; ?>
        </td>
        <td>
            <?php if($this->action === 'view'): ?>
            <?php echo $articleHistory['CoauthorStatus']['name']; ?>
            <?php else: ?>
            <?php echo $this->Form->input('coauthor_status_id', array('type' => 'select')); ?>
            <?php endif; ?>
        </td>
    </tbody>
</table>
