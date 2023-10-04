<?php

namespace App\Repository;

use App\Entity\Plante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use SebastianBergmann\Environment\Console;

/**
 * @extends ServiceEntityRepository<Plante>
 *
 * @method Plante|null find($id, $lockMode = null, $lockVersion = null)
 * @method Plante|null findOneBy(array $criteria, array $orderBy = null)
 * @method Plante[]    findAll()
 * @method Plante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Plante::class);
    }

//    /**
//     * @return Plante[] Returns an array of Plante objects
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

//    public function findOneBySomeField($value): ?Plante
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }



 // méthode propre: recherche par filtres
 public function recherchePlanteFiltres($filtres)
 {




     $em = $this->getEntityManager();
  

     $query = $em->createQuery (
             "SELECT plante FROM App\Entity\Plante plante
             WHERE
             (plante.exposition IN (:exposition)
             AND 
             plante.besoinEau IN (:besoinEau)
             AND 
             plante.lieuCultive IN (:lieuCultive))
           
             "
     );

     
    
   
    //  dd($filtres['exposition']);
     $query->setParameter("exposition", $filtres['exposition']);
     $query->setParameter("besoinEau", $filtres['besoinEau']);
     $query->setParameter("lieuCultive", $filtres['lieuCultive']);
     $res = $query->getResult();
     return $res;
 }

}
