<?php

namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrouverPlanteController extends AbstractController
{

    // Action qui AFFICHE le formulaire
    #[Route("/plante/index")]
    #[Route('/plante/trouver_une_plante', name:'maPlante')]
    public function planteIndex()
    {
        return $this->render('plante/trouver_une_plante.html.twig');
    }

}