<?php
App::uses('RoutineModel', 'Routine.Model');

/**
 * ArticleHistory Model
 *
 */
class ArticleHistory extends RoutineModel {

    public $actsAs = array(
        'Search.Searchable',
    );

    public $belongsTo = array(
        'AuthorStatus',
        'PublisherStatus',
        'CoauthorStatus',
        'User',
    );

    public $filterArgs = array(
        array('name' => 'article_id', 'type' => 'value'),
    );

    /**
     * pushHistory
     * 履歴追加
     *
     * @param $article_id
     */
    public function pushHistory($article_id){
        $this->Article = ClassRegistry::init('Article');
        try {
            $article = $this->Article->view($article_id);
        } catch (NotFoundException $e) {
            // for SoftDeletable
            return true;
        }
        $data = array('ArticleHistory' => $article['Article']);
        unset($data['ArticleHistory']['id']);
        $data['ArticleHistory']['article_id'] = $article_id;
        $user = AuthComponent::user();
        if (!empty($user)) {
            $data['ArticleHistory']['user_id'] = $user['id'];
        }
        return $this->add($data);
    }

}