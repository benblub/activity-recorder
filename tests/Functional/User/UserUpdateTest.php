<?php
namespace App\Tests\Functional\User;

use App\Test\CustomApiTestCase;

class UserUpdateTest extends CustomApiTestCase
{
    public function testUpdateUser()
    {
        $client = self::createClient();

        $user = $this->createUser();

        $client->request('PUT', '/api/users/' . $user->getId(), [
            'headers' => [
                'X-AUTH-TOKEN' => $user->getApiToken()
            ],
            'json' => [
                'email' => 'changed_' . $user->getEmail()
            ]
        ]);

        $this->assertResponseStatusCodeSame(self::RESOURSE_RESPONSE_200);
    }
}