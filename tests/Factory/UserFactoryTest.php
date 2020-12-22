<?php


namespace App\Tests\Factory;


use App\Entity\User;
use App\Factory\UserFactory;
use PHPUnit\Framework\TestCase;

class UserFactoryTest extends TestCase
{
    /**
     * @var UserFactory
     */
    private $factory;

    public function setUp() : void
    {
        $this->factory = new UserFactory();
    }

    public function testCreateUser()
    {
        $user = $this->factory->createUser('email@email.com', true);

        $this->assertInstanceOf(User::class, $user);
        $this->assertContains(User::ROLE_USER, $user->getRoles());
    }

    public function testCreateAdmin()
    {
        $user = $this->factory->createAdmin('email@email.com', true);

        $this->assertInstanceOf(User::class, $user);
        $this->assertContains(User::ROLE_ADMIN, $user->getRoles());
    }
}