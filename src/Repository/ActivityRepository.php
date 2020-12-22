<?php

namespace App\Repository;

use App\Entity\Activity;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Activity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activity[]    findAll()
 * @method Activity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activity::class);
    }

   /**
    * @return Activity[] Returns an array of Activity objects
    */
    public function findByUser(User $user) : ?array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.user = :user')
            ->setParameter('user', $user)
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return array[] Returns an array of Activity data
     */
    public function ifnull() : ?array
    {
        return $this->getEntityManager()->createQuery("
          SELECT 
            IFNULL(a.description, ''), 
            IFNULL(a.id, ''),
            IFNULL(a.activityDate, ''),
            IFNULL(a.performendTime, ''),
            IFNULL(a.user, '')
          FROM App\Entity\Activity a
        ")
            ->getResult();
    }


    /*
    public function findOneBySomeField($value): ?Activity
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
