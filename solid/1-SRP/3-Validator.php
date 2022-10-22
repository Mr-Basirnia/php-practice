<?php

class Validator
{
    public function validate(array $params)
    {
        if (!isset($params['first_name'], $params['last_name'], $params['email'], $params['password'])) {
            throw new ValidateException('Data is not valid');
        }
    }
}
