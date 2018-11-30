<?php

namespace App\Repository;

use App\Entity\RequestEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RequestEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method RequestEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method RequestEntity[]    findAll()
 * @method RequestEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RequestEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RequestEntity::class);
    }

//    /**
//     * @return RequestEntity[] Returns an array of RequestEntity objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RequestEntity
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
