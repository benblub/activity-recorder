<?php

namespace App\Tests\Functional\Activity;

use App\Test\CustomApiTestCase;

class ActivityDeleteTest extends CustomApiTestCase
{
    public function testDeleteActivity()
    {
        $client = $this::createClient();

        $activity = $this->createActivity();

        $res = $client->request('DELETE', '/api/activities/' . $activity->getId(), [
            'headers' => [
                'X-AUTH-TOKEN' => $activity->getUser()->getApiToken()
            ]
        ]);

        $this->assertResponseStatusCodeSame(self::RESOURCE_DELETED_204);
    }
}