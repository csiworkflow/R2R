<?php
App::uses('RoutineModel', 'Routine.Model');

/**
 * User Model
 *
 */
class User extends RoutineModel {

    public $displayField = 'name';

    public $validate = array(
        'username' => array('required', 'notempty', 'unique'),
        'password' => array('required', 'notempty'),
    );

    public $validationSets = array(
        'add' => array(
            'username' => array('required', 'notempty', 'unique'),
            'name' => array('required', 'notempty'),
            'password' => array('required', 'notempty'),
            'password_confirm' => array('required', 'notempty', 'password_confirm'),
        ),
        'edit' => array(
            'username' => array('required', 'notempty', 'unique'),
            'name' => array('required', 'notempty'),
            'password' => array('notempty'),
            'password_confirm' => array('notempty', 'password_confirm'),
        ),
    );

    public function add($data = null) {
        if (!empty($data)) {
            $this->create();
            $this->set($data);
            $result = $this->validates();
            if ($result === false) {
                throw new ValidationException();
            }
            $this->data['User']['password'] = Security::hash($this->data['User']['password'], null, true);
            $this->data['User']['password_confirm'] = Security::hash($this->data['User']['password_confirm'], null, true);
            $this->data['User']['delete_flg'] = false;
            $result = $this->save();
            if ($result !== false) {
                $this->data = array_merge($data, $result);
                return true;
            } else {
                throw new OutOfBoundsException(__('Could not save, please check your inputs.', true));
            }
        }
    }

    public function edit($id = null, $data = null) {
        $user = $this->find('first', array(
                'conditions' => array(
                    "{$this->alias}.{$this->primaryKey}" => $id,
                )));

        if (empty($user)) {
            throw new OutOfBoundsException(__('Invalid Access', true));
        }

        if (!empty($data)) {
            $this->set($data);

            if ( empty($this->data['User']['update_password_flg']) ) {
                // update_password_flgが未チェックであればバリデーションを実行しないようにカラムを削除する
                unset($this->data['User']['password']);
                unset($this->data['User']['password_confirm']);
            } else {
                if ( !empty($this->data['User']['password']) ) {
                    $this->data['User']['password'] = Security::hash($this->data['User']['password'], null, true);
                }
                if ( !empty($this->data['User']['password_confirm']) ) {
                    $this->data['User']['password_confirm'] = Security::hash($this->data['User']['password_confirm'], null, true);
                }
            }

            $this->setValidation('edit');

            $result = $this->save(null, true);
            if ($result) {
                $this->data = $result;
                return true;
            } else {
                throw new ValidationException();
            }
        } else {
            unset($user['User']['password']);
            return $user;
        }
    }
}