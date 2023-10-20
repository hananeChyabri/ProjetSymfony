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

        $user = $this->getUser();

        if ($formulaireFiltrePlante->isSubmitted() && $formulaireFiltrePlante->isValid()) {

            $rep = $doctrine->getRepository(Plante::class);
            $resultats = $rep->recherchePlanteFiltres($formulaireFiltrePlante->getData());


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
                if ($user){
                    $arrPlante['like'] = $user->getPlantes()->contains($plante) ? true : false;
                }
                else {
                    $arrPlante['like'] = false;
                }


                $plantes[] = $arrPlante;

            }




            $response = $serializer->serialize($plantes, 'json');


            return new Response($response);
        } else {
            //chercher toutes les plantes dans la base de donnees
            $user = $this->getUser();
            if (!$user) {
            }
            $em = $doctrine->getManager();

            $rep = $doctrine->getRepository(Plante::class);
            $res = $rep->recherchePlanteFiltres();
            $vars = ['listePlantes' => $res, 'form' => $formulaireFiltrePlante];
        }
        return $this->render('plante/trouver_une_plante2.html.twig', $vars);
    }
}
