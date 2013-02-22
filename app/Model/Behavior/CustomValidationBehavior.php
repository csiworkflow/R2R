<?php

class CustomValidationBehavior extends ModelBehavior {

    /**
     * isUniqueIssn
     * ISSN+掲載誌巻+掲載誌号+論文開始ページでのユニークチェック
     *
     * @param $arg
     */
    public function isUniqueIssn(Model $model, $field){
        // メタデータにDOIがある場合は判定しない
        if (!empty($model->data[$model->alias]['identifier_doi'])) {
            return true;
        }
        $issn = empty($model->data[$model->alias]['identifier_issn']) ? '' : $model->data[$model->alias]['identifier_issn'];
        $volume = empty($model->data[$model->alias]['identifier_volume']) ? '' : $model->data[$model->alias]['identifier_volume'];
        $number = empty($model->data[$model->alias]['identifier_number']) ? '' : $model->data[$model->alias]['identifier_number'];
        $spage = empty($model->data[$model->alias]['identifier_spage']) ? '' : $model->data[$model->alias]['identifier_spage'];

        // ISSNがない場合は判定しない
        if ($issn === '') {
            return true;
        }
        $fields = array(
            'identifier_issn' => $issn,
            'identifier_volume' => $volume,
            'identifier_number' => $number,
            'identifier_spage' => $spage,
        );
        return $model->isUnique($fields, false);
    }

    /**
     * notEmptyPasswordEdit
     * 修正モード時のUsers::passwordバリデーション
     *
     * @param type $model
     * @param type $field
     * @return boolean
     */
    public function notEmptyPasswordEdit(&$model, $field) {
        // update_password_flgにチェックが入ってる場合だけ
        if ( $model->data[$model->alias]['update_password_flg'] == 1 ) {
            $value = array_shift($field);
            return !empty($value);
        }

        return true;
    }
}