<?php

namespace App\Models;

class User
{
    private static ?User $instance = null;
    private string $firstName;
    private string $lastName;

    public function __construct()
    {
    }

    public static function getInstance(): User
    {
        if (self::$instance === null)
            self::$instance = new self();

        return self::$instance;
    }

    public function getFullName(): string
    {
        return "{$this->getFirstName()} {$this->getLastName()}";
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName)
    {
        $this->firstName = trim($firstName);
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName)
    {
        $this->lastName = trim($lastName);
    }
}