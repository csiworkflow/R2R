<?php
// http://bakery.cakephp.org/articles/dardosordi/2008/07/29/multivalidatablebehavior-using-many-validation-rulesets-per-model
// MultivalidatableBehabior for CakePHP2
// @author Dardo Sordi
// @licence MIT licence
class MultivalidatableBehavior extends ModelBehavior {

    /**
     * Stores previous validation ruleset
     *
     * @var Array
     */
    private $__oldRules = array();

    /**
     * Stores Model default validation ruleset
     *
     * @var unknown_type
     */
    private $__defaultRules = array();

    public function setUp(&$model, $config = array()) {
        $this->__defaultRules[$model->name] = $model->validate;
    }

    /**
     * Installs a new validation ruleset
     *
     * If $rules is an array, it will be set as current validation ruleset,
     * otherwise it will look into Model::validationSets[$rules] for the ruleset to install
     *
     * @param Object $model
     * @param Mixed $rules
     */
    public function setValidation(&$model, $rules = array()) {
        if (is_array($rules)){
            $this->_setValidation($model, $rules);
        } elseif (isset($model->validationSets[$rules])) {
            $this->setValidation($model, $model->validationSets[$rules]);
        }
    }

    /**
     * Restores previous validation ruleset
     *
     * @param Object $model
     */
    public function restoreValidation(&$model) {
        $model->validate = $this->__oldRules[$model->name];
    }

    /**
     * Restores default validation ruleset
     *
     * @param Object $model
     */
    public function restoreDefaultValidation(&$model) {
        $model->validate = $this->__defaultRules[$model->name];
    }

    /**
     * Merges validation rulesets
     *
     * @param Object $model
     * @param Array $rules
     */
    public function mergeValidation(&$model, $rules){
        if (!$rules || !isset($this->validationSets[$rules])) {
            return false;
        }
        $this->validate = Set::merge($this->validate, $this->validationSets[$rules]);
        return true;
    }

    /**
     * Sets a new validation ruleset, saving the previous
     *
     * @param Object $model
     * @param Array $rules
     */
    private function _setValidation(&$model, $rules) {
        $this->__oldRules[$model->name] = $model->validate;
        $model->validate = $rules;
    }

  }