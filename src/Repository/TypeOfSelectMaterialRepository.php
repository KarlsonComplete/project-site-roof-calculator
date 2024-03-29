<?php

namespace App\Repository;

use App\Entity\TypeOfSelectMaterial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\MaterialType;

/**
 * @extends ServiceEntityRepository<TypeOfSelectMaterial>
 *
 * @method TypeOfSelectMaterial|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeOfSelectMaterial|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeOfSelectMaterial[]    findAll()
 * @method TypeOfSelectMaterial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeOfSelectMaterialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeOfSelectMaterial::class);
    }

    public function save(TypeOfSelectMaterial $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TypeOfSelectMaterial $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function SearchForIdenticalId($materialType):array{
        return $this->createQueryBuilder('t')
            ->andWhere('t.materialType = :materialType')
            ->setParameter('materialType',$materialType)
            ->orderBy('t.title', 'ASC')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return TypeOfSelectMaterial[] Returns an array of TypeOfSelectMaterial objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypeOfSelectMaterial
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
