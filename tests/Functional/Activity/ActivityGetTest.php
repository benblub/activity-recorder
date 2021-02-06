<?php


namespace App\Tests\Functional\Activity;


use App\Test\CustomApiTestCase;

class ActivityGetTest extends CustomApiTestCase
{
    public function testGetActivity()
    {
        $client = $this::createClient();

        $activity = $this->createActivity();

        $client->request('GET', '/api/activities/' . $activity->getId(), [
            'headers' => [
                'X-AUTH-TOKEN' => $activity->getUser()->getApiToken()
            ]
        ]);

        $this->assertResponseHeaderSame('Content-Type', 'application/ld+json; charset=utf-8');
        $this->assertResponseStatusCodeSame(self::RESOURSE_RESPONSE_200);
    }
}