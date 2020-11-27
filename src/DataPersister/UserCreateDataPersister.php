<?php


namespace App\DataPersister;


use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserCreateDataPersister implements ContextAwareDataPersisterInterface
{
    private $manager;

    private $passwordEncoder;
    /**
     * @var ContextAwareDataPersisterInterface
     */
    private ContextAwareDataPersisterInterface $decorated;

    public function __construct(ContextAwareDataPersisterInterface $decorated, EntityManagerInterface $manager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->manager = $manager;
        $this->passwordEncoder = $passwordEncoder;
        $this->decorated = $decorated;
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
        /** @var User $data */
        if (
            $data instanceof User && (
                ($context['collection_operation_name'] ?? null) === 'post'
            )
        ) {
            if ($data->getPlainPassword()) {
                $data->setPassword(
                    $this->passwordEncoder->encodePassword($data, $data->getPlainPassword())
                );

                $data->eraseCredentials();
            }

            $data->setRoles(["ROLE_USER"]);
            $data->setEnabled(false);
            $this->manager->persist($data);
            $this->manager->flush();
        }
    }

    public function remove($data, array $context = [])
    {
        return $this->decorated->remove($data, $context);
    }

}