<?php
namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Activity;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

final class ActivityDataPersister implements ContextAwareDataPersisterInterface
{
    private $decorated;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $manager;

    public function __construct(ContextAwareDataPersisterInterface $decorated, LoggerInterface $logger, EntityManagerInterface $manager)
    {
        $this->decorated = $decorated;
        $this->logger = $logger;
        $this->manager = $manager;
    }

    public function supports($data, array $context = []): bool
    {
        return $this->decorated->supports($data, $context);
    }

    public function persist($data, array $context = [])
    {
        if (!$data instanceof Activity) {
            return $this->decorated->persist($data, $context);
        }

        /** CreateActivity */
        if (
            $data instanceof Activity && (
                ($context['collection_operation_name'] ?? null) === 'post'
            )
        ) {
            $this->logger->info("Activity created");
            $this->manager->persist($data);
            $this->manager->flush();
        }


        /** UpdateActivity */
        if (
            $data instanceof Activity && (
                ($context['item_operation_name'] ?? null) === 'put'
            )
        ) {
            $this->logger->info("Activity updated!");
            $this->manager->persist($data);
            $this->manager->flush();
        }
    }

    public function remove($data, array $context = [])
    {
        return $this->decorated->remove($data, $context);
    }
}