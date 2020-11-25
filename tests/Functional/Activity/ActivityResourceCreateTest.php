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
                'performendTime' => 2.5,
                'text' => 'awesome code created!'
            ]
        ]);
        $this->assertResponseStatusCodeSame(self::RESOURSE_CREATED_201);
    }
}