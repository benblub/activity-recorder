<?php

namespace App\Tests\Functional\Activity;

use App\Test\CustomApiTestCase;
use DateTime;

class ActivityCreateTest extends CustomApiTestCase
{
    /**
     * create a Resource as anymous
     */
    public function testCreateActivity()
    {
        $client = self::createClient();

        $user = $this->createUser();

        $d = new DateTime();
        $client->request('POST', '/api/activities', [
            'json' => [
                'activityDate' => $d->format('Y-m-d'),
                'performendTime' => 2.5,
                'description' => 'awesome code created!',
                'user' => '/api/users/8'
            ],
            'headers' => [
                'X-AUTH-TOKEN' => $user->getApiToken()
            ]
        ]);
        $this->assertResponseStatusCodeSame(self::RESOURSE_CREATED_201);
    }
}