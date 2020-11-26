<?php

namespace App\Tests\Functional\Activity;


use App\Test\CustomApiTestCase;

class ActivityDeleteTest extends CustomApiTestCase
{
    public function testDeleteActivity()
    {
        $client = $this::createClient();

        $activity = $this->createActivity();

        $client->request('DELETE', '/api/activities/' . $activity->getId());

        $this->assertResponseStatusCodeSame(self::RESOURCE_DELETED_204);
    }
}