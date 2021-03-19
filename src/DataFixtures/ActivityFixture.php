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
        for ($i = 0; $i < 10000; $i++) {
            $activity = new Activity();
            $activity->setUser($this->getReference(UserFixture::APP_USER));
            $activity->setDescription(rand(1, 9999) . ' Awesome work! ');
            $activity->setPerformendTime(rand(1.0, 10.0));
            $int= mt_rand(1262055681,1862055681);
            $date = new \DateTime();
            $date->setTimestamp($int);
            $activity->setActivityDate($date);

            $manager->persist($activity);
        }


        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixture::class,
        );
    }
}
