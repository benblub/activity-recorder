<?php

namespace App\Tests\Functional\Activity;

use App\Test\CustomApiTestCase;
use DateTime;

class ActivityCreateTest extends CustomApiTestCase
{
    /**
     * @dataProvider activityDataSets
     */
    public function testCreateActivity(float $performendTime, string $description, string $activityDate)
    {
        $client = self::createClient();
        $user = $this->createUser();
        $d = new DateTime();

        $client->request('POST', '/api/activities', [
            'json' => [
                'activityDate' => $activityDate,
                'performendTime' => $performendTime,
                'description' => $description,
                'user' => '/api/users/' . $user->getId()
            ],
            'headers' => [
                'X-AUTH-TOKEN' => $user->getApiToken()
            ]
        ]);

        $this->assertResponseHeaderSame('Content-Type', 'application/ld+json; charset=utf-8');
        $this->assertResponseStatusCodeSame(self::RESOURSE_CREATED_201);
    }

    public function activityDataSets()
    {
        $d = new DateTime();

        return [
            [1.5, '1 awesome code created!', $d->format('Y-m-d')],
            [2.5, '2 awesome code created!', $d->format('Y-m-d')],
            [4.5, '3 awesome code created!', $d->format('Y-m-d')],
        ];
    }
}