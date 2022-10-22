<?php

class Register
{
    public function save()
    {
        $params = $_POST;

        (new Validator())->validate($params);
        (new User())->save($params);
    }
}
