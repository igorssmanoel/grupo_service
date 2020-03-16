<?php

namespace App\Validators;

class Validator
{
    protected $errors = [];
    protected $params = [];
    protected $rules = [];
    protected $translated = [];
    protected $table = '';

    public function required($field_name)
    {
        $value = $this->params[$field_name] ?? null;
        if (!isset($value) || empty($value)) {
            $field = isset($this->translated[$field_name]) ? $this->translated[$field_name] : $field_name;
            $this->errors[$field_name] = 'Campo ' . $field . ' é obrigatório.';
        }
    }

    public function unique($field_name)
    {
        $value = $this->params[$field_name] ?? null;
        if ($value) {
            $class = 'App\\Model\\' . $this->table;
            $element = $class::where($field_name, $value);
            if ($element->count() > 0) {
                $field = isset($this->translated[$field_name]) ? $this->translated[$field_name] : $field_name;
                $this->errors[$field_name] = 'O ' . $field . ' ' . $value . ' já existe.';
            }
        }
    }

    public function numeric($field_name)
    {
        $value = $this->params[$field_name];
        if (!is_numeric($value)) {
            $field = isset($this->translated[$field_name]) ? $this->translated[$field_name] : $field_name;
            $this->errors[$field_name] = 'O ' . $field . ' precisa ser númerico';
        }
    }

    public function validate()
    {
        foreach ($this->rules as $field_name => $rule_detail) {
            if (isset($this->params)) {
                $rule_details = explode(":", $rule_detail);
                foreach ($rule_details as $key => $rule) {
                    if ($rule == 'required') {
                        $this->required($field_name);
                    }
                    if ($rule == 'unique') {
                        $this->unique($field_name);
                    }
                    if ($rule == 'numeric') {
                        $this->numeric($field_name);
                    }
                }
            }
        }
    }



    public function is_valid()
    {
        return !count($this->errors);
    }

    public function get_errors()
    {
        return $this->errors;
    }
}
