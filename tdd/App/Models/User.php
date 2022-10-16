<?php

namespace App\Models;

class User
{
    private static ?User $instance = null;
    private string $firstName;
    private string $lastName;
    private string $fullName;

    public function __construct()
    {
    }

    public static function getInstance(): User
    {
        if (self::$instance === null)
            self::$instance = new self();

        return self::$instance;
    }

    /**
     * If the property exists, and the method name starts with 'set', then set the property to the first argument.
     * If the method name starts with 'get', then return the property
     *
     * @param string $name The name of the method being called.
     * @param array $arguments The arguments passed to the method.
     */
    public function __call(string $name, array $arguments)
    {
        $property = lcfirst(substr($name, 3));

        if (property_exists($this, $property)) {
            if ('set' == substr($name, 0, 3)) $this->$property = trim($arguments[0]);
            if ('get' == substr($name, 0, 3)) return $this->$property;
        }
    }
}