<?php

namespace App\Tests\Functional\Activity;

use App\Test\CustomApiTestCase;


class ActivityUpdateTest extends CustomApiTestCase
{
    public function testUpdateActivity()
    {
        $client = self::createClient();

        $activity = $this->createActivity();

        $client->request('PUT', '/api/activities/' . $activity->getId(), [
            'headers' => [
                'X-AUTH-TOKEN' => $activity->getUser()->getApiToken()
            ],
            'json' => [
                'performendTime' => 55,
                'description' => 'i was not finished with my awesome coding session!'
            ]
        ]);

        $this->assertResponseHeaderSame('Content-Type', 'application/ld+json; charset=utf-8');
        $this->assertResponseStatusCodeSame(self::RESOURSE_RESPONSE_200);
    }
}
