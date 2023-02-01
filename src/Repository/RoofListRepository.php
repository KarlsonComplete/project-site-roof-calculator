<?php

namespace App\Repository;

use App\Entity\RoofList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RoofList>
 *
 * @method RoofList|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoofList|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoofList[]    findAll()
 * @method RoofList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoofListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RoofList::class);
    }

//    /**
//     * @return RoofList[] Returns an array of RoofList objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RoofList
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
