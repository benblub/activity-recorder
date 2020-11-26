<?php


namespace App\Tests\Functional\Activity;


use App\Test\CustomApiTestCase;

class ActivityGetCollectionTest extends CustomApiTestCase
{
    public function testGetCollectionActivity()
    {
        $client = self::createClient();

        $this->createActivity();
        $this->createActivity();

        $response = $client->request('GET', '/api/activities');

        $this->assertResponseStatusCodeSame(self::RESOURSE_RESPONSE_200);
    }
}