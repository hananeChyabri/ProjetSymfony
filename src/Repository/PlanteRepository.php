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
        $dql = 'SELECT plante FROM App\Entity\Plante plante WHERE 1=1';

        $exposition = isset($filtres['exposition']) ? $filtres['exposition'] : null;
        $besoinEau = isset($filtres['besoinEau']) ? $filtres['besoinEau'] : null;
        $lieuCultive = isset($filtres['lieuCultive']) ? $filtres['lieuCultive'] : null;
        $resistanceFroid = isset($filtres['resistanceFroid']) ? $filtres['resistanceFroid'] : null;
        $couleur = isset($filtres['couleur']) ? $filtres['couleur'] : null;

        if ($exposition) {
            $dql .= ' AND plante.exposition IN (:exposition)';
        }
        if ($besoinEau) {
            $dql .= ' AND plante.besoinEau IN (:besoinEau)';
        }
        if ($lieuCultive) {
            $dql .= ' AND plante.lieuCultive IN (:lieuCultive)';
        }
        if ($resistanceFroid) {
            $dql .= ' AND plante.resistanceFroid IN (:resistanceFroid)';
        }
        if ($couleur) {
            $dql .= ' AND plante.couleurFleur IN (:couleur)';
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
        if ($resistanceFroid) {

            $query->setParameter('resistanceFroid', $filtres['resistanceFroid']);
        }
        if ($couleur) {

            $query->setParameter('couleur', $filtres['couleur']);
        }



        $resultats = $query->getResult();
        // dd($resultats);

        return $resultats;
    }
}
