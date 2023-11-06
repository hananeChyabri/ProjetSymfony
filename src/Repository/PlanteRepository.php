<?php

namespace App\Repository;

use App\Entity\Plante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use SebastianBergmann\Environment\Console;
use Symfony\Component\Validator\Constraints\Length;

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
    public function recherchePlanteFiltres($filtres = [])
    {



        $em = $this->getEntityManager();
     


        $dql = 'SELECT plante FROM App\Entity\Plante plante';

        $exposition = isset($filtres['exposition']) ? $filtres['exposition'] : null;
        $besoinEau = isset($filtres['besoinEau']) ? $filtres['besoinEau'] : null;
        $lieuCultive = isset($filtres['lieuCultive']) ? $filtres['lieuCultive'] : null;

        if ($exposition) {
            $dql .= ' WHERE plante.exposition IN (:exposition)';
        }
        if ($besoinEau) {

            $dql .= ($exposition ? ' AND' : ' WHERE') . ' plante.besoinEau IN (:besoinEau)';
        }
        if ($lieuCultive) {

            $dql .= ($exposition ? ' AND' : ' WHERE') . ' plante.lieuCultive IN (:lieuCultive)';
        }
        $query = $em->createQuery($dql);

        if ($exposition) {

            $query->setParameter('exposition', $filtres['exposition']);
        }
        if ($besoinEau) {

            $query->setParameter('besoinEau', $filtres['besoinEau']);
        }
        if ($lieuCultive) {

            $query->setParameter('lieuCultive', $filtres['lieuCultive']);
        }



        $resultats = $query->getResult();
        
        
        return $resultats;
    }


     // méthode propre: recherche par filtres
     public function recherchePlante($nom)
     {


     $em=$this->getEntityManager();
     $query = $em->createQuery(
        "SELECT p FROM App\Entity\Plante p
        WHERE p.nom LIKE :nom"
    );
 
     $query->setParameter("nom","%".$nom."%");
     $resultat=$query->getResult();
 
       
     return $resultat;
 
         
    
     }
}
