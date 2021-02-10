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

        $client->request('GET', '/api/activities', [
            'headers' => [
                'X-AUTH-TOKEN' => $activity->getUser()->getApiToken()
            ]
        ]);

        $this->assertResponseHeaderSame('Content-Type', 'application/ld+json; charset=utf-8');
        $this->assertResponseStatusCodeSame(self::RESOURSE_RESPONSE_200);
    }

    /**
     * Test For ROLE_USER collection is auto filtered
     */
    public function testGetCollectionActivityIsAutoFiltered()
    {
        $client = self::createClient();

        $activity = $this->createActivity();
        $this->createActivity();

        $client->request('GET', '/api/activities', [
            'headers' => [
                'X-AUTH-TOKEN' => $activity->getUser()->getApiToken()
            ]
        ]);

        $this->assertJsonContains(['hydra:totalItems' => 1]);
    }

    /**
     * Test For ROLE_ADMIN collection is not auto filtered
     */
    public function testGetCollectionActivityIsNotAutoFiltered()
    {
        $client = self::createClient();

        $admin = $this->createUser('ROLE_ADMIN');
        $activity = $this->createActivity();
        $this->createActivity();

        $response = $client->request('GET', '/api/activities', [
            'headers' => [
                'X-AUTH-TOKEN' => $admin->getApiToken()
            ]
        ]);

        $data = json_decode($response->getContent(), true);
        $this->assertGreaterThan(1, $data["hydra:totalItems"]);
    }
}