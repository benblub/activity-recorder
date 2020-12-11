<?php

namespace App\tests\Service\User;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserHandlerTest extends TestCase
{
    public function testActivate()
    {
        $user = new User();
        $user->setEnabled(true);

        $this->assertEquals(true, $user->getEnabled());
    }
}