<?php
namespace App\Tests\Functional\User;

use App\Test\CustomApiTestCase;

class UserGetTest extends CustomApiTestCase
{
    public function testGetUser(): void
    {
        $client = self::createClient();

        $user = $this->createUser();

        $client->request('GET', '/api/users/' . $user->getId(), [
            'headers' => [
                'X-AUTH-TOKEN' => $user->getApiToken()
            ]
        ]);

        $this->assertResponseHeaderSame('Content-Type', 'application/ld+json; charset=utf-8');
        $this->assertResponseStatusCodeSame(self::RESOURSE_RESPONSE_200);
    }
}