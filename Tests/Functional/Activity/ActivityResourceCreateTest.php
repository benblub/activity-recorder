<?php

namespace App\Tests\Functional\Activity;

use App\Test\CustomApiTestCase;
use DateTime;

class ActivityResourceCreateTest extends CustomApiTestCase
{
    /**
     * create a Resource as anymous
     */
    public function testCreateActivity()
    {
        $client = self::createClient();

        $d = new DateTime();
        $client->request('POST', '/api/activities', [
            'json' => [
                'activityDate' => $d->format('Y-m-d'),
                'performendTime' => 1.0,
                'text' => 'New activity created!'
            ]
        ]);
        $this->assertResponseStatusCodeSame(self::RESOURSE_CREATED_201);
    }
}