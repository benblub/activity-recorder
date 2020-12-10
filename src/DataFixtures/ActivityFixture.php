<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ActivityFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $activity = new Activity();
        $activity->setUser($this->getReference(UserFixture::APP_USER));
        $activity->setDescription('Awesome work!');
        $activity->setPerformendTime(1.0);
        $activity->setActivityDate(new \DateTime());

        $manager->persist($activity);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixture::class,
        );
    }
}
