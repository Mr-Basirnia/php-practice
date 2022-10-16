<?php


use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testThatWeCanGetUserFirstName()
    {
        $user = User::getInstance();
        $user->setFirstName('amin');
        $this->assertEquals('amin', $user->getFirstName());
    }

    public function testThatWeCanGetUserLastName()
    {
        $user = User::getInstance();
        $user->setLastName('basirnia');
        $this->assertEquals('basirnia', $user->getLastName());
    }

    public function testThatWeCanGetFullName()
    {
        $user = User::getInstance();
        $user->setFirstName('reza');
        $user->setLastName('iri');

        $this->assertEquals('reza iri', $user->getFullName());
    }
}
