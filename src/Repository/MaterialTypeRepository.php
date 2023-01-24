<?php

namespace App\Repository;

use App\Entity\MaterialType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MaterialType>
 *
 * @method MaterialType|null find($id, $lockMode = null, $lockVersion = null)
 * @method MaterialType|null findOneBy(array $criteria, array $orderBy = null)
 * @method MaterialType[]    findAll()
 * @method MaterialType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaterialTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MaterialType::class);
    }

    public function save(MaterialType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MaterialType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function SearchForIdenticalId(int $slug):array{
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT m
            FROM App\Entity\MaterialType m
            WHERE m.coating=:slug
            ORDER BY m.title ASC,m.id ASC',
            $_POST['id_coating']
        )->setParameter('slug',$slug);

        return $query->getResult();
    }

//    /**
//     * @return MaterialType[] Returns an array of MaterialType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MaterialType
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
