<?php


namespace App\DataPersister;


use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $manager;
    /**
     * @var ContextAwareDataPersisterInterface
     */
    private ContextAwareDataPersisterInterface $decorated;
    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(
        ContextAwareDataPersisterInterface $decorated,
        EntityManagerInterface $manager,
        UserPasswordEncoderInterface $passwordEncoder
    )
    {
        $this->manager = $manager;
        $this->decorated = $decorated;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function supports($data, array $context = []): bool
    {
        return $this->decorated->supports($data, $context);
    }

    /**
     * @param User $data
     */
    public function persist($data, array $context = [])
    {
        if (!$data instanceof User) {
            return $this->decorated->persist($data, $context);
        }

        /** CreateUser */
        if (
            $data instanceof User && (
                ($context['collection_operation_name'] ?? null) === 'post'
            )
        ) {
            $this->createUser($data);
        }

        /** UpdateUser */
        if (
            $data instanceof User && (
                ($context['item_operation_name'] ?? null) === 'put'
            )
        ) {
            $this->manager->persist($data);
            $this->manager->flush();
        }

        //return $result;
    }

    public function remove($data, array $context = [])
    {
        return $this->decorated->remove($data, $context);
    }

    /**
     * @param User $user
     */
    private function createUser($user) : void
    {
        if ($user->getPlainPassword()) {
            $user->setPassword(
                $this->passwordEncoder->encodePassword($user, $user->getPlainPassword())
            );

            $user->eraseCredentials();
        }

        $user->setRoles(["ROLE_USER"]);
        $user->setEnabled(false);
        $user->setActivateToken(uniqid());
        $user->setApiToken(uniqid());

        $this->manager->persist($user);
        $this->manager->flush();
    }
}