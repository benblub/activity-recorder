<?php
namespace App\Tests\Functional\User;

use App\Test\CustomApiTestCase;

class UserCreateTest extends CustomApiTestCase
{
    public function testCreateUser()
    {
        $client = self::createClient();

        $res = $client->request('POST', '/api/users', [
           'json' => [
               'email' => uniqid() . '@test.com',
               'password' => 'secret'
           ]
        ]);

        $this->assertResponseHeaderSame('Content-Type', 'application/ld+json; charset=utf-8');
        $this->assertResponseStatusCodeSame(self::RESOURSE_CREATED_201);
    }
}