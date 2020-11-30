<?php


namespace App\Tests\Functional\User;


use App\Test\CustomApiTestCase;

class UserLoginTest extends CustomApiTestCase
{
    /**
     * We test here to retrive an apiToken from Post Request with email and password.
     * The User dont get authenticated here, for LoginFormAuth call /weblogin instead
     *
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function testLogin()
    {
        $client = self::createClient();

        $user = $this->createUser();

        $response =$client->request('POST', '/login', [
            'json' => [
                'email' => $user->getEmail(),
                'password' => 'superSecret'
            ]
        ]);

        $this->assertResponseStatusCodeSame(self::RESOURSE_RESPONSE_200);
        $this->assertContains('apiToken', $response->getContent());
    }
}