<?php

namespace App\Tests\Functional\Activity;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;
use App\Entity\User;
use App\Test\CustomApiTestCase;
use App\Tests\Factory\UserFactory;
use DateTime;
use Zenstruck\Foundry\Proxy;

class ActivityCreateTest extends CustomApiTestCase
{
    private Client $client;
    /**
     * @var User|Proxy
     */
    private Proxy $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = UserFactory::createOne();
        $this->client = self::createClient();
        $this->client->setDefaultOptions([
            'headers' => [
                'X-AUTH-TOKEN' => $this->user->getApiToken()
            ]
        ]);
    }

    /**
     * @dataProvider activityDataSets
     */
    public function testCreateActivity(float $performendTime, string $description, string $activityDate)
    {
        $d = new DateTime();

        $this->client->request('POST', '/api/activities', [
            'json' => [
                'activityDate' => $activityDate,
                'performendTime' => $performendTime,
                'description' => $description,
                'user' => '/api/users/' . $this->user->getId()
            ],
        ]);

        $this->assertResponseHeaderSame('Content-Type', 'application/ld+json; charset=utf-8');
        $this->assertResponseStatusCodeSame(self::RESOURSE_CREATED_201);
    }

    public function activityDataSets()
    {
        $d = new DateTime();

        return [
            [1.5, '1 awesome code created!', $d->format('Y-m-d')],
            [2.5, '2 awesome code created!', $d->format('Y-m-d')],
            [4.5, '3 awesome code created!', $d->format('Y-m-d')],
        ];
    }
}