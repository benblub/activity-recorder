<?php

namespace App\Tests\Service\User;


use App\Factory\UserFactory;
use PHPUnit\Framework\TestCase;

class UserHandlerTest extends TestCase
{
    /**
     * @var UserFactory
     */
    private $factory;

    public function setUp() : void
    {
        $this->factory = new UserFactory();
    }

    public function testActivate()
    {
        $user = $this->factory->createUser('mail@mail.com', false);

        $this->assertEquals(false, $user->getEnabled());

        $user->setEnabled(true);

        $this->assertEquals(true, $user->getEnabled());
    }
}