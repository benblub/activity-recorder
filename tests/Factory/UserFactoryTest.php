<?php


namespace App\Tests\Factory;


use App\Entity\User;
use App\Factory\UserFactory;
use PHPUnit\Framework\TestCase;

class UserFactoryTest extends TestCase
{
    public function testCreateUser()
    {
        $factory = new UserFactory();
        $user = $factory->createUser();

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(['ROLE_USER'], $user->getRoles());
        $this->assertTrue($user->getEnabled());
    }
}