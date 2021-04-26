<?php

namespace App\Tests\Repository;

use App\Entity\User;
use App\Test\CustomApiTestCase;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class UserRepositoryTest extends CustomApiTestCase
{
    private EntityManagerInterface $entityManager;
    private UserPasswordEncoder $passwordEncoder;

    public function setUp(): void
    {
        $kernel = self::bootKernel();
        $container = self::$container;
        $this->passwordEncoder = $container->get('security.user_password_encoder.generic');

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testUpgradePassword(): void
    {
        $user = $this->createUser();
        $userRepository = $this->entityManager->getRepository(User::class);

        $userRepository->upgradePassword($user, 'newpassword');

        $dbUser = $userRepository->findOneBy(['email' => $user->getEmail()]);

        $user->setPassword(
            $this->passwordEncoder->encodePassword($user, 'newpassword')
        );

        $this->assertEquals($user->getPassword(), $dbUser->getPassword());
    }
}
