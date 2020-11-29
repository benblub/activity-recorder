<?php
namespace App\Service\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

final class UserHandler
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function activate(string $activateToken)
    {
        $user = $this->manager->getRepository(User::class)
            ->findOneBy([
                'activateToken' => $activateToken
            ]);

        // todo : if we throw errors the client should get some 400 or 500 Response
        if (!$user) {
            throw new \Exception('User not found for activateToken: ' . $activateToken);
        }

        $user->setEnabled(true);

        $this->manager->persist($user);
        $this->manager->flush();
    }
}