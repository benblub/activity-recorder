<?php
namespace App\Tests\Functional\User;

use App\Test\CustomApiTestCase;

class UserCreateTest extends CustomApiTestCase
{
    public function testCreateUser()
    {
        $client = self::createClient();

        $client->request('POST', '/api/users', [
           'json' => [
               'email' => uniqid() . '@test.com',
               'password' => 'secret'
           ]
        ]);

        $this->assertResponseStatusCodeSame(self::RESOURSE_CREATED_201);
    }
}