<?php


namespace App\Tests\Functional\Activity;


use App\Test\CustomApiTestCase;

class ActivityGetTest extends CustomApiTestCase
{
    public function testGetActivity()
    {
        $client = $this::createClient();

        $activity = $this->createActivity();

        $client->request('GET', '/api/activities/' . $activity->getId());

        $this->assertResponseStatusCodeSame(self::RESOURSE_RESPONSE_200);
    }
}