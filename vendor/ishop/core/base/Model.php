<?php


namespace ishop\base;


use ishop\Db;
use Valitron\Validator;

abstract class Model
{
    public $attributes = [];
    public $errors = [];
    public $rules = [];

    public function __construct()
    {
        Db::instance();
    }

    public function load($data)
    {
        foreach ($this->attributes as $key => $value) {
            if (isset($data[$key])) {
                $this->attributes[$key] = $data[$key];
            }
        }
    }

    public function validate($data)
    {
        Validator::langDir(WWW . '/validator/lang');
        Validator::lang('ru');
        $validator = new Validator($data);
        $validator->rules($this->rules);

        if ($validator->validate()) {
            return true;
        }

        $this->errors = $validator->errors();
        return false;
    }

    public function getErrors()
    {
         $errors = '<ul>';

         foreach ($this->errors as $error) {
             foreach ($error as $item) {
                 $errors .= "<li>$item</li>";
             }
         }

         $errors .= '</ul>';
         $_SESSION['error'] = $errors;
    }

    public function save($table)
    {
        $bean = \R::dispense($table);
        foreach ($this->attributes as $key => $value) {
            $bean->$key = $value;
        }

        return \R::store($bean);
    }

    public function update($table, $id) {
        $bean = \R::load($table, $id);
        foreach ($this->attributes as $key => $value) {
            $bean->$key = $value;
        }
        return \R::store($bean);
    }
}