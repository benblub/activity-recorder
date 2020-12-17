<?php


namespace App\Tests\Repository;


use App\Entity\Activity;
use App\Entity\User;
use App\Factory\UserFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ActivityRepositoryIntegrationTest extends KernelTestCase
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var UserFactory
     */
    private $factory;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->factory = new UserFactory();
    }

    public function testFindByUser()
    {
        $user = $this->factory->createUser('hero@mail.com', true);
        $user->setPassword(1234);
        $user->setApiToken(1234);

        $activity = new Activity();
        $activity->setUser($user);
        $activity->setDescription('awesome!');
        $activity->setActivityDate(new \DateTime());
        $activity->setPerformendTime(0.5);

        $this->entityManager->persist($user);
        $this->entityManager->persist($activity);
        $this->entityManager->flush();


        $activityFromDatabase = $this->entityManager->getRepository(Activity::class)
            ->findByUser($user);

        $this->assertContains($activity, $activityFromDatabase);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}