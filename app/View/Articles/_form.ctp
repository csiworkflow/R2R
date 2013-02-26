<table class="table table-bordered table-condensed article-table">
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
                <?php if(in_array($fieldName, array('title', 'contributor_author', 'date_issued'))): ?>
                <span class="label label-important"><?php echo __('Required'); ?></span>
                <?php endif; ?>
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
                <?php if(empty($article['Article'][$fieldName])): ?>
                ---
                <?php else: ?>
                <?php echo ${Inflector::pluralize($fieldName)}[$article['Article'][$fieldName]]; ?>
                <?php endif;  ?>
                <?php else: ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'select', 'options' => ${Inflector::pluralize($fieldName)}, 'empty' => true, 'class' => '')); ?>
                <?php endif;  ?>

                <?php elseif(in_array($fieldName, array(
                  'description_abstract',
                  ))): ?>
                <?php // textarea ?>
                <?php if($this->action === 'view'): ?>
                <?php echo nl2br($article['Article'][$fieldName]); ?>
                <?php else: ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'textarea', 'class' => 'input-xxlarge')); ?>
                <?php endif; ?>
                <?php elseif(in_array($fieldName, array('id'))): ?>
                <?php // hidden ?>
                <?php echo $this->Form->value($fieldName); ?>
                <?php else: ?>
                <?php if($this->action === 'view'): ?>
                <?php echo $article['Article'][$fieldName]; ?>
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
<h4><?php echo __('Publisher Info') ?></h4>

<table class="table table-bordered table-condensed article-table">
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
                <?php if(empty($article['Article'][$fieldName])): ?>
                ---
                <?php else: ?>
                <?php echo ${Inflector::pluralize($fieldName)}[$article['Article'][$fieldName]]; ?>
                <?php endif;  ?>
                <?php else: ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'select', 'options' => ${Inflector::pluralize($fieldName)}, 'empty' => true, 'class' => '')); ?>
                <?php endif;  ?>
                <?php elseif(in_array($fieldName, array(
                  'publisher_policy_type',
                  'publisher_open_condition',
                  'publisher_other',
                  'publisher_contact_info',
                  'publisher_remarks',
                  ))): ?>
                <?php // textarea ?>
                <?php if($this->action === 'view'): ?>
                <?php echo nl2br($article['Article'][$fieldName]); ?>
                <?php else: ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'textarea', 'class' => 'input-xxlarge')); ?>
                <?php endif; ?>
                <?php elseif(in_array($fieldName, array('id'))): ?>
                <?php // hidden ?>
                <?php echo $this->Form->value($fieldName); ?>
                <?php elseif(in_array($fieldName, array('publisher_embargo_period'))): ?>
                <?php // datepicker ?>
                <?php if($this->action === 'view'): ?>
                <?php echo $article['Article'][$fieldName]; ?>
                <?php else: ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'text', 'class' => 'datepicker')); ?>
                <?php endif; ?>

                <?php elseif(in_array($fieldName, array(
                  'publisher_source_uri',
                  'publisher_policy_uri',
                  ))): ?>
                <?php // uri ?>
                <?php if($this->action === 'view'): ?>
                <a target="_blank" href="<?php echo $article['Article'][$fieldName]; ?>"><?php echo $article['Article'][$fieldName]; ?></a>
                <?php else: ?>
                <?php if (!empty($this->data['Article'][$fieldName])): ?>
                <a target="_blank" href="<?php echo $this->data['Article'][$fieldName]; ?>">[<?php echo __('Link'); ?>]</a>
                <?php endif; ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'text', 'class' => 'input-xxlarge')); ?>
                <?php endif; ?>

                <?php else: ?>
                <?php if($this->action === 'view'): ?>
                <?php echo $article['Article'][$fieldName]; ?>
                <?php else: ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'text', 'class' => 'input-xxlarge')); ?>
                <?php endif; ?>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h4><?php echo __('Author Info') ?></h4>

<table class="table table-bordered table-condensed article-table">
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
                <?php if(empty($article['Article'][$fieldName])): ?>
                ---
                <?php else: ?>
                <?php echo ${Inflector::pluralize($fieldName)}[$article['Article'][$fieldName]]; ?>
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
                <?php echo nl2br($article['Article'][$fieldName]); ?>
                <?php else: ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'textarea', 'class' => 'input-xxlarge')); ?>
                <?php endif; ?>
                <?php elseif(in_array($fieldName, array('id'))): ?>
                <?php // hidden ?>
                <?php echo $this->Form->value($fieldName); ?>
                <?php else: ?>
                <?php if($this->action === 'view'): ?>
                <?php echo $article['Article'][$fieldName]; ?>
                <?php else: ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'text', 'class' => 'input-xxlarge')); ?>
                <?php endif; ?>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h4><?php echo __('Coauthor Info') ?></h4>

<?php for($i = 1; $i <= 5; $i++): ?>
<table class="table table-bordered table-condensed article-table">
    <tbody>
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
                <?php if(empty($article['Article'][$fieldName])): ?>
                ---
                <?php else: ?>
                <?php echo ${Inflector::pluralize(preg_replace('/[1-5]$/', '', $fieldName))}[$article['Article'][$fieldName]]; ?>
                <?php endif;  ?>
                <?php else: ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'select', 'options' => ${Inflector::pluralize(preg_replace('/[1-5]$/', '', $fieldName))}, 'empty' => true, 'class' => '')); ?>
                <?php endif;  ?>
                <?php elseif(in_array($fieldName, array(
                  'coauthor_remarks' . $i,
                  ))): ?>
                <?php // textarea ?>
                <?php if($this->action === 'view'): ?>
                <?php echo nl2br($article['Article'][$fieldName]); ?>
                <?php else: ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'textarea', 'class' => 'input-xxlarge')); ?>
                <?php endif; ?>
                <?php elseif(in_array($fieldName, array('id'))): ?>
                <?php // hidden ?>
                <?php echo $this->Form->value($fieldName); ?>
                <?php else: ?>
                <?php if($this->action === 'view'): ?>
                <?php echo $article['Article'][$fieldName]; ?>
                <?php else: ?>
                <?php echo $this->Form->input($fieldName, array('type' => 'text', 'class' => 'input-xxlarge')); ?>
                <?php endif; ?>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endfor; ?>

<?php if($this->action !== 'add'): ?>
<h3><?php echo __('File Status'); ?></h3>
<table class="table table-bordered table-condensed">
    <?php for($i = 1;$i <= 5; $i++): ?>
    <tr>
        <th>
            <?php echo __('File') ?><?php echo $i; ?>
        </th>
        <td>
            <?php echo $this->Label->link($article['Article']['file' . $i]); ?>
        </td>
    </tr>
    <?php endfor; ?>
</table>
<?php endif; ?>

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
            <?php echo $article['AuthorStatus']['name']; ?>
            <?php else: ?>
            <?php echo $this->Form->input('author_status_id', array('type' => 'select')); ?>
            <?php endif; ?>
        </td>
        <td>
            <?php if($this->action === 'view'): ?>
            <?php echo $article['PublisherStatus']['name']; ?>
            <?php else: ?>
            <?php echo $this->Form->input('publisher_status_id', array('type' => 'select')); ?>
            <?php endif; ?>
        </td>
        <td>
            <?php if($this->action === 'view'): ?>
            <?php echo $article['CoauthorStatus']['name']; ?>
            <?php else: ?>
            <?php echo $this->Form->input('coauthor_status_id', array('type' => 'select')); ?>
            <?php endif; ?>
        </td>
    </tbody>
</table>
