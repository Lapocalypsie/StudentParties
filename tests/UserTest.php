<?php

use PHPUnit\Framework\TestCase;
use App\Entity\User;

class UserTest extends TestCase
{
    public function testGetSetEmail()
    {
        $user = new User();
        $user->setEmail('user@example.com');
        $this->assertEquals('user@example.com', $user->getEmail());
    }

    public function testGetSetRoles()
    {
        $user = new User();
        $roles = ['ROLE_ADMIN'];
        $user->setRoles($roles);
        $this->assertEquals(array_unique(array_merge($roles, ['ROLE_USER'])), $user->getRoles());
    }

    public function testGetSetPassword()
    {
        $user = new User();
        $user->setPassword('password');
        $this->assertEquals('password', $user->getPassword());
    }

    public function testGetSetPlainPassword()
    {
        $user = new User();
        $user->setPlainPassword('plainpassword');
        $this->assertEquals('plainpassword', $user->getPlainPassword());
    }

    public function testEraseCredentials()
    {
        $user = new User();
        $user->setPlainPassword('plainpassword');
        $user->eraseCredentials();
        $this->assertNull($user->getPlainPassword());
    }

    public function testGetUserIdentifier()
    {
        $user = new User();
        $user->setEmail('user@example.com');
        $this->assertEquals('user@example.com', $user->getUserIdentifier());
    }

    public function testGetIsAdmin()
    {
        $user = new User();
        $this->assertNull($user->getIsAdmin());
        $user->setIsAdmin(true);
        $this->assertTrue($user->getIsAdmin());
    }
}
