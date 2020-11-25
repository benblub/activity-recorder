<?php
namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Activity;
use Psr\Log\LoggerInterface;

final class ActivityDataPersister implements ContextAwareDataPersisterInterface
{
    private $decorated;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    public function __construct(ContextAwareDataPersisterInterface $decorated, LoggerInterface $logger)
    {
        $this->decorated = $decorated;
        $this->logger = $logger;
    }

    public function supports($data, array $context = []): bool
    {
        return $this->decorated->supports($data, $context);
    }

    public function persist($data, array $context = [])
    {
        $result = $this->decorated->persist($data, $context);

        if (
            $data instanceof Activity && (
                ($context['collection_operation_name'] ?? null) === 'post'
            )
        ) {
            $this->logger->info("Activity created");
        }

        return $result;
    }

    public function remove($data, array $context = [])
    {
        return $this->decorated->remove($data, $context);
    }
}