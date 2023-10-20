<?php

namespace App\Controller;

use doctrine;
use App\Entity\Plante;
use App\Form\FiltrePlanteType;
use App\Repository\PlanteRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DetaillePlanteController extends AbstractController
{

    #[Route('/plante/detaille/{id}', name: 'detaillePlante')]
    public function AfficherDetaillePlante(Request $req, PlanteRepository $rep)

    {
     

        $id = $req->get('id');
        $plante = $rep->find($id);

        $vars = ['Plante' => $plante];
         return $this->render('plante/afficher_detaille_plante.html.twig', $vars);
        }
       
    
}
