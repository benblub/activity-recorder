<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Exception\NotHappyException;
use App\Repository\ActivityRepository;
use App\Validator\HappyCoder;
use App\Validator\IsUserOwnerClass;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use DateTimeInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ActivityRepository::class)
 * @ApiResource(
 *     collectionOperations={
 *          "get" = { "security" = "is_granted('ROLE_USER')" },
 *          "post" = { "security" = "is_granted('ROLE_USER')" }
 *     },
 *     itemOperations={
 *          "get" = { "security" = "is_granted('ROLE_USER') and object.getUser() == user" },
 *          "put" = { "security" = "is_granted('ROLE_USER') and object.getUser() == user" },
 *          "delete" = { "security" = "is_granted('ROLE_USER') and object.getUser() == user" }
 *     },
 *     attributes={
 *      "order"={"id": "DESC"}
 *     }
 * )
 * @ApiFilter(DateFilter::class, properties={"activityDate"})
 * @ApiFilter(SearchFilter::class, properties={"id": "exact", "performendTime": "exact", "description": "partial"})
 * @ApiFilter(OrderFilter::class, properties={"id", "performendTime", "description", "activityDate"}, arguments={"orderParameterName"="order"})
 * @IsUserOwnerClass()
 */
class Activity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="date")
     * @Groups({"user:read", "user:write"})
     */
    private DateTimeInterface $activityDate;

    /**
     * @ORM\Column(type="float")
     * @Groups({"user:read", "user:write"})
     * @Assert\NotBlank()
     */
    private float $performendTime;

    /**
     * @ORM\Column(type="text")
     * @Groups({"user:read", "user:write"})
     * @Assert\NotBlank()
     * @HappyCoder()
     */
    private string $description;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="activities")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $user;

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

        if ($description === 'unhappy') {
            throw new NotHappyException();
        }

        $this->description = $description;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
