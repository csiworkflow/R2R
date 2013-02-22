<?php
/**
 * AdditionalValidationRulesBehavior
 *
 * jpn: 追加のバリデーションルール
 */
class AdditionalValidationRulesBehavior extends ModelBehavior {

    /**
     * setUp
     *
     * @param Model $model
     */
    public function setUp(Model $model){
    }

    /**
     * notEmptyWith
     * jpn: $withに指定されたフィールドに1つでも値が入っていたらnotEmptyを発動
     *
     */
    public function notEmptyWith(Model $model, $field, $with = array()){
        if (empty($with)) {
            return true;
        }
        $key = key($field);
        $value = array_shift($field);
        $v = new Validation();
        foreach ((array)$with as $withField) {
            if (!array_key_exists($withField, $model->data[$model->alias])) {
                continue;
            }
            if($v->notEmpty($model->data[$model->alias][$withField])) {
                return $v->notEmpty($value);
            }
        }
        return true;
    }

    /**
     * notEmptyWithout
     * jpn: $withoutに指定されたフィールドに1つも値が入っていなかったらnotEmptyを発動
     *
     */
    public function notEmptyWithout(Model $model, $field, $without = array()){
        $key = key($field);
        $value = array_shift($field);
        $v = new Validation();
        if (empty($without)) {
            return $v->notEmpty($value);
        }
        foreach ((array)$without as $withoutField) {
            if (!array_key_exists($withoutField, $model->data[$model->alias])) {
                continue;
            }
            if(!$v->notEmpty($model->data[$model->alias][$withoutField])) {
                return true;
            }
        }
        return $v->notEmpty($value);
    }

    /**
     * hiraganaAndSpace
     * jpn: 全角ひらがなと全角スペースのみ
     *
     */
    public function hiraganaAndSAndSpace(Model $model, $field){
        $key = key($field);
        $value = array_shift($field);
        $field = array($key => str_replace('　','', $value));
        return $model->hiraganaAndSOnly($field);
    }

    /**
     * katakanaAndSpace
     * jpn: 全角カタカナと全角スペースのみ
     *
     */
    public function katakanaAndSpace(Model $model, $field){
        $key = key($field);
        $value = array_shift($field);
        $field = array($key => str_replace('　','', $value));
        return $model->katakanaOnly($field);
    }

    /**
     * recordExists
     * jpn: belongsToなどで指定しているModelのレコード側が存在していること
     *
     * @param $arg
     */
    public function recordExists(Model $model, $field, $belongsToModelName){
        $key = key($field);
        $value = array_shift($field);
        if (is_array($belongsToModelName)) {
            $belongsToModelName = Inflector::classify(preg_replace('/_id$/', '', $key));
        }
        $belongsToModel = ClassRegistry::init($belongsToModelName);
        return $belongsToModel->exists($value);
    }

    /**
     * inListFromConfigure
     * jpn: Configure::write()で設定されているarray()からinListを生成
     *
     */
    public function inListFromConfigure(Model $model, $field, $listname){
        $value = array_shift($field);
        $list = Configure::read($listname);
        if ($list !== array_values($list)) {
            // jpn: selectのoptionsにそのまま設置するような連想配列を想定
            $list = array_keys($list);
        }
        return Validation::inList($value, $list);
    }
}