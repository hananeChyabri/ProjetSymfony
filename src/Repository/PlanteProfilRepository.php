<?php

namespace App\Repository;

use App\Entity\PlanteProfil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlanteProfil>
 *
 * @method PlanteProfil|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanteProfil|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanteProfil[]    findAll()
 * @method PlanteProfil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanteProfilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanteProfil::class);
    }

//    /**
//     * @return PlanteProfil[] Returns an array of PlanteProfil objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PlanteProfil
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
