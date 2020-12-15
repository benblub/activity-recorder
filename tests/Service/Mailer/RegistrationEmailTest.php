<?php

namespace App\tests\Service\Mailer;

use App\Entity\User;
use App\Service\Mailer\RegistrationEmail;
use PHPUnit\Framework\TestCase;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class RegistrationEmailTest extends TestCase
{
    public function testSendEmail()
    {
        $stub = $this->createMock(RegistrationEmail::class);

        $stub->method('sendEmail')
            ->willReturn(new TemplatedEmail());

        $user = new User();

        $this->assertInstanceOf(TemplatedEmail::class, $stub->sendEmail($user));
    }
}
