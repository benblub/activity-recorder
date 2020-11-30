<?php


namespace App\Tests\Functional\User;


use App\Test\CustomApiTestCase;

class UserLoginTest extends CustomApiTestCase
{
    public function testLogin()
    {
        $client = self::createClient();

        $user = $this->createUser();

        $response =$client->request('POST', '/login?XDEBUG_SESSION_START=PHPSTORM', [
            'json' => [
                'email' => $user->getEmail(),
                'password' => 'superSecret'
            ]
        ]);

        $this->assertResponseStatusCodeSame(self::RESOURSE_RESPONSE_200);
        $this->assertContains('apiToken', $response->getContent());
    }
}