<?php

namespace App\Controller;
use App\Entity\Plante;
use App\Form\FiltrePlanteType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecherchePlanteController extends AbstractController
{

    // Action qui affiche toutes les plantes

    #[Route('/plante/recherche_plante', name: 'recherchePlante')]
    public function RecherchePlantes(Request $req, ManagerRegistry $doctrine, SerializerInterface $serializer): Response

    {
        $nom = $req->get('nom');
        $entityManager = $doctrine->getManager();
        $rep = $entityManager->getRepository(Plante::class);
        $user = $this->getUser();
    

                $resultats = $rep->recherchePlante($nom);
               
    
               


                $plantes = [];
            foreach ($resultats as $plante) {
                $arrPlante = [];
                $arrPlante['id'] = $plante->getId();
                $arrPlante['nom'] = $plante->getNom();
                $arrPlante['exposition'] = $plante->getExposition();
                $arrPlante['besoinEau'] = $plante->getBesoinEau();
                $arrPlante['lieuCultive'] = $plante->getLieuCultive();
                $arrPlante['description'] = $plante->getDescription();
                $arrPlante['niveauSoin'] = $plante->getNiveauSoin();
                $arrPlante['images'] = [];
                foreach ($plante->getImages() as $image) {
                    // rajouter le nom de l'auteur à l'array
                    $arrPlante['images'][] = $image->getUrl();
                }
                // voir si la plante est dans la liste des Users
            
                $arrPlante['like'] = false;
                if ($user)
                $arrPlante['like'] = $user->getPlantes()->contains($plante) ? true : false;
          
                $plantes[] = $arrPlante;

            }
            $response = $serializer->serialize($plantes, 'json');
            return new Response($response);
             
                
 return new Response($response);
        
       
    }

    //         $rep = $doctrine->getRepository(Plante::class);
    //         $resultats = $rep->recherchePlante($formulaireFiltrePlante->getData());


    //         $plantes = [];
    //         foreach ($resultats as $plante) {
    //             $arrPlante = [];
    //             $arrPlante['id'] = $plante->getId();
    //             $arrPlante['nom'] = $plante->getNom();
    //             $arrPlante['exposition'] = $plante->getExposition();
    //             $arrPlante['besoinEau'] = $plante->getBesoinEau();
    //             $arrPlante['lieuCultive'] = $plante->getLieuCultive();
    //             $arrPlante['description'] = $plante->getDescription();
    //             $arrPlante['niveauSoin'] = $plante->getNiveauSoin();
    //             $arrPlante['images'] = [];
    //             foreach ($plante->getImages() as $image) {
    //                 // rajouter le nom de l'auteur à l'array
    //                 $arrPlante['images'][] = $image->getUrl();
    //             }
    //             // voir si la plante est dans la liste des Users
    //             $arrPlante['like'] = false;
    //             if ($user)
    //             $arrPlante['like'] = $user->getPlantes()->contains($plante) ? true : false;
                


    //             $plantes[] = $arrPlante;

    //         }
    //         $response = $serializer->serialize($plantes, 'json');
    //         return new Response($response);
    //     } else {
    //         //chercher toutes les plantes dans la base de donnees
          
          

    //         $rep = $doctrine->getRepository(Plante::class);
    //         $res = $rep->recherchePlanteFiltres();
    //         $vars = ['listePlantes' => $res, 'form' => $formulaireFiltrePlante];
    //     }
    //     return $this->render('plante/trouver_une_plante2.html.twig', $vars);
    // }
}
