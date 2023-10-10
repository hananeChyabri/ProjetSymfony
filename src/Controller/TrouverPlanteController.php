<?php

namespace App\Controller;

use doctrine;
use App\Entity\Plante;
use App\Form\FiltrePlanteType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TrouverPlanteController extends AbstractController
{

    // Action qui affiche toutes les plantes

    #[Route('/plante/trouver_une_plante', name: 'maPlante')]
    public function RecherchePlantes(Request $req, ManagerRegistry $doctrine, SerializerInterface $serializer): Response

    {

        $formulaireFiltrePlante = $this->createForm(FiltrePlanteType::class);

        $formulaireFiltrePlante->handleRequest($req);   

        if ($formulaireFiltrePlante->isSubmitted() && $formulaireFiltrePlante->isValid()) {
       
            $rep = $doctrine->getRepository(Plante::class);
            $resultats = $rep->recherchePlanteFiltres($formulaireFiltrePlante->getData());


            $plantes = [];
            foreach ($resultats as $plante) {
                $arrPlante = [];
                
                $arrPlante['nom'] = $plante->getNom();
                $arrPlante['exposition'] = $plante->getExposition();
                $arrPlante['besoinEau'] = $plante->getBesoinEau();
                $arrPlante['lieuCultive'] = $plante->getLieuCultive();
                $arrPlante['images'] = [];
                foreach ($plante->getImages() as $image) {
                    // rajouter le nom de l'auteur à l'array
                    $arrPlante['images'][] = $image->getUrl();
                }
          
                // rajouter le livre ayant l'array d'auteurs incrusté
                $plantes[] = $arrPlante;
            }
         
   
         
          
            $response = $serializer->serialize($plantes, 'json', [AbstractNormalizer::IGNORED_ATTRIBUTES => ['images']]);
         

            return new Response ($response);

        }
        else{
    //chercher toutes les plantes dans la base de donnees
    $em = $doctrine->getManager();
    $query = $em->createQuery("SELECT plante FROM App\Entity\Plante plante");
    $res = $query->getResult();
    $vars = ['listePlantes' => $res,'form' => $formulaireFiltrePlante];
        }
        return $this->render('plante/trouver_une_plante.html.twig', $vars);
    }

    


}
