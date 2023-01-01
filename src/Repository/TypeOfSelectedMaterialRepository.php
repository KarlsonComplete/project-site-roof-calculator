<?php

namespace App\Repository;

use App\Entity\TypeOfSelectedMaterial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeOfSelectedMaterial>
 *
 * @method TypeOfSelectedMaterial|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeOfSelectedMaterial|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeOfSelectedMaterial[]    findAll()
 * @method TypeOfSelectedMaterial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeOfSelectedMaterialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeOfSelectedMaterial::class);
    }

    public function save(TypeOfSelectedMaterial $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TypeOfSelectedMaterial $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return TypeOfSelectedMaterial[] Returns an array of TypeOfSelectedMaterial objects
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

//    public function findOneBySomeField($value): ?TypeOfSelectedMaterial
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
