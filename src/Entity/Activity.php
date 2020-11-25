<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ActivityRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ActivityRepository::class)
 * @ApiResource()
 * @ApiFilter(DateFilter::class, properties={"activityDate"})
 * @ApiFilter(SearchFilter::class, properties={"id": "exact", "performendTime": "exact", "description": "partial"})
 */
class Activity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $activityDate;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank()
     */
    private $performendTime;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActivityDate(): ?DateTimeInterface
    {
        return $this->activityDate;
    }

    public function setActivityDate(DateTimeInterface $activityDate): self
    {
        $this->activityDate = $activityDate;

        return $this;
    }

    public function getPerformendTime(): ?float
    {
        return $this->performendTime;
    }

    public function setPerformendTime(float $performendTime): self
    {
        $this->performendTime = $performendTime;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
