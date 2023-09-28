<?php

namespace App\Controller;


use doctrine;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrouverPlanteController extends AbstractController
{

    // Action qui AFFICHE le formulaire

    #[Route('/plante/trouver_une_plante', name: 'maPlante')]
    public function planteIndex(ManagerRegistry $doctrine)

    {
        //chercher toutes les plantes dans la base de donnees
        $em = $doctrine->getManager();
        $query = $em->createQuery("SELECT plante FROM App\Entity\Plante plante");
        $res = $query->getResult();
        $vars = ['listePlantes' => $res];
        // dd($res); // charger la vue qui affiche le resultat
        return $this->render('plante/trouver_une_plante.html.twig', $vars);
    }
}
