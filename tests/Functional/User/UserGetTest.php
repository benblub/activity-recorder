<?php
namespace App\Tests\Functional\User;

use App\Test\CustomApiTestCase;

class UserGetTest extends CustomApiTestCase
{
    public function testGetUser()
    {
        $client = self::createClient();

        $user = $this->createUser();

        $client->request('GET', '/api/users/' . $user->getId(), [
            'headers' => [
                'X-AUTH-TOKEN' => $user->getApiToken()
            ]
        ]);

        $this->assertResponseStatusCodeSame(self::RESOURSE_RESPONSE_200);
    }
}