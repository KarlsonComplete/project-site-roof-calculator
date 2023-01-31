<?php

namespace App\Repository;

use App\Entity\Coating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Coating>
 *
 * @method Coating|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coating|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coating[]    findAll()
 * @method Coating[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoatingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coating::class);
    }

    public function save(Coating $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Coating $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllOrderByAscTitleQueryBuilder(): QueryBuilder
    {
       return $this->createQueryBuilder('c')->orderBy('c.title', 'ASC');
    }

//    /**
//     * @return Coating[] Returns an array of Coating objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Coating
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
