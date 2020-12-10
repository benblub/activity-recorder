<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public const APP_USER = 'app-user';

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $user->setApiToken(uniqid());
        $user->setEnabled(true);
        $user->setEmail(uniqid().'@email.com');
        $user->setPassword('password');

        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::APP_USER, $user);
    }
}
