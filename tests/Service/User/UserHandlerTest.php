<?php

namespace App\tests\Service\User;


use App\Factory\UserFactory;
use PHPUnit\Framework\TestCase;

class UserHandlerTest extends TestCase
{
    /**
     * @var UserFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new UserFactory();
    }

    public function testActivate()
    {
        $user = $this->factory->createUser('mail@mail.com', false, ['ROLE_USER']);

        $this->assertEquals(false, $user->getEnabled());

        $user->setEnabled(true);

        $this->assertEquals(true, $user->getEnabled());
    }
}