<?php

class Validator
{
    private $passed = false, $errors = [], $db = null;

    /**
     * QueryBuilder $qb - экземляр класса QueryBuilder
     */
    public function __construct(QueryBuilder $qb)
    {
        $this->db = $qb;
    }

    /**
     * array $source - массив данных, который необходимо проверить
     * array $items - правила валидации
     * return Validator - экзмепляр данного класса Validator
     */
    public function check($source, $items = [])
    {
        foreach ($items as $item => $rules)
        {
            foreach ($rules as $rule => $rule_value)
            {
                $value = $source[$item];

                if($rule == 'required' && empty($value))
                {
                    $this->addError("$item is required");
                }
                elseif (!empty($value))
                {
                    switch ($rule)
                    {
                        case 'min':
                            if(strlen($value) < $rule_value)
                                $this->addError("$item must be a minimum of $rule_value characters.");
                            break;

                        case 'max':
                            if(strlen($value) > $rule_value)
                                $this->addError("$item must be a maximum of $rule_value characters.");
                            break;

                        case 'matches':
                            if($value != $source[$rule_value])
                                $this->addError("$rule_value must match {$item}.");
                            break;

                        case 'unique':
                            $check = $this->db->get($rule_value, [$item, '=', $value]);
                            if($check->count())
                                $this->addError("$item already exists.");
                            break;

                        case 'email':
                            if(!filter_var($value, FILTER_VALIDATE_EMAIL))
                                $this->addError("$item is not an email.");
                            break;

                    }
                }
            }
        }

        if(empty($this->errors))
            $this->passed = true;

        return $this;
    }

    /**
     * string $error - сообщение об ошибке
     */
    public function addError($error)
    {
        $this->errors[] = $error;
    }

    /**
     * return array - массив ошибок
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * return bool - true валидация пройдения, false валидация не пройдена
     */
    public function passed()
    {
        return $this->passed;
    }
}