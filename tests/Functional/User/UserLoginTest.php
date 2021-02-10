<?php declare(strict_types=1);


namespace App\Tests\Functional\User;


use App\Test\CustomApiTestCase;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

final class UserLoginTest extends CustomApiTestCase
{
    /**
     * We test here to retrive an apiToken from Post Request with email and password.
     * The User dont get authenticated here, for LoginFormAuth call /weblogin instead
     *
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function testLogin(): void
    {
        $client = self::createClient();

        $user = $this->createUser();

        $response =$client->request('POST', '/api/login', [
            'json' => [
                'email' => $user->getEmail(),
                'password' => 'superSecret'
            ]
        ]);

        $this->assertResponseHeaderSame('Content-Type', 'application/json');
        $this->assertResponseStatusCodeSame(self::RESOURSE_RESPONSE_200);
        //$this->assertContains('apiToken', $response->getContent());
    }
}
