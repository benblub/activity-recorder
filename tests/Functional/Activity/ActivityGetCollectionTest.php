<?php


namespace App\Tests\Functional\Activity;


use App\Test\CustomApiTestCase;

class ActivityGetCollectionTest extends CustomApiTestCase
{
    public function testGetCollectionActivity()
    {
        $client = self::createClient();

        $activity = $this->createActivity();
        $this->createActivity();

        $response = $client->request('GET', '/api/activities', [
            'headers' => [
                'X-AUTH-TOKEN' => $activity->getUser()->getApiToken()
            ]
        ]);

        $this->assertResponseStatusCodeSame(self::RESOURSE_RESPONSE_200);
    }
}