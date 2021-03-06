<?php


namespace App\Tests\Repository;


use App\Entity\Activity;
use App\Test\CustomApiTestCase;
use Doctrine\ORM\EntityManagerInterface;

class ActivityRepositoryIntegrationTest extends CustomApiTestCase
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testFindByUser()
    {
        $activity = $this->createActivity();
        $user = $activity->getUser();

        $activityFromDatabase = $this->entityManager->getRepository(Activity::class)
            ->findByUser($user);

        $this->assertContains($activity, $activityFromDatabase);

        // todo clear database between each test
        // $this->assertCount(1, $activityFromDatabase);
    }

    public function testifnull()
    {
        $this->createActivity();

        $activityFromDatabase = $this->entityManager->getRepository(Activity::class)
            ->ifnull();

        $this->assertIsArray($activityFromDatabase);
        $this->assertArrayHasKey(1, $activityFromDatabase);
        //$this->assertContains('awesome code written!', $activityFromDatabase[95]);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}