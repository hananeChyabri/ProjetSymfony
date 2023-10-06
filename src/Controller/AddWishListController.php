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
use Symfony\Component\DependencyInjection\Loader\Configurator\security;

class AddWishListController extends AbstractController
{




    #[Route('/plante/listSouhait/{id}', name: 'addWishList')]
    public function AjouterListeSouhait(Request $req, ManagerRegistry $doctrine, SerializerInterface $serializer): Response

    {

        //Obtenir le user Actuel

        $user = $this->getUser();

        // //obtenir plante dans la base de donne avec find 
        $id = $req->get('id');

        $entityManager = $doctrine->getManager();
        $rep = $entityManager->getRepository(Plante::class);

        $plante = $rep->find($id);

        //Ajouter la Plante au User
        $user->addPlante($plante);

        $entityManager->persist($user);

        // Exécution des opérations en base de données
        $entityManager->flush();


        return $this->render('home/index.html.twig');
    }
}
