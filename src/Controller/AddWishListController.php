<?php

namespace App\Controller;

use doctrine;
use App\Entity\Plante;
use App\Form\FiltrePlanteType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Loader\Configurator\security;
use Symfony\Component\Validator\Constraints\Length;

class AddWishListController extends AbstractController
{




    #[Route('/plante/listSouhait/', name: 'addWishList')]
    public function AjouterListeSouhait(Request $req, ManagerRegistry $doctrine, SerializerInterface $serializer): Response

    {

        //Obtenir le user Actuel
        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse(['message' => 'Connexion requise ! Connectez-vous pour ajouter une plante à la liste des favoris.'], 404);
        } else {

          

            // //obtenir plante dans la base de donne avec find 
            $id = $req->get('id');
            $entityManager = $doctrine->getManager();
            $rep = $entityManager->getRepository(Plante::class);

            $plante = $rep->find($id);

            $planteAjoutee = $user->getPlantes()->contains($plante);
            // dd($planteAjoutee);

            // indique si dans ce click on va rajouter une plante ou pas
            $rajoute = null;

            if ($planteAjoutee) {
                // Supprimer la Plante au User 
                $user->removePlante($plante);
                $rajoute = false;
            } else {
                //Ajouter la Plante au User
                $user->addPlante($plante);
                $rajoute = true;

                // $entityManager->persist($user);

                // Exécution des opérations en base de données
            }
            $entityManager->flush();
            return new JsonResponse(['rajoute' => $rajoute], 200);
        }
    }


    #[Route('/plante/favorit_plantes/', name: 'showWishList')]
    public function AfficherListeSouhait(Request $req, ManagerRegistry $doctrine, SerializerInterface $serializer): Response

    {

        //Obtenir le user Actuel



        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse(['message' => 'Utilisateur non trouvé'], 404);
        } else {


            $favorites = $user->getPlantes();



            $plantes = [];
            foreach ($favorites as $plante) {
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
                $arrPlante['like'] = false;
                if ($user)
                $arrPlante['like'] = $user->getPlantes()->contains($plante) ? true : false;

                // rajouter le livre ayant l'array d'auteurs incrusté
                $plantes[] = $arrPlante;
            }


            return new JsonResponse($plantes);
        }
    }
}
