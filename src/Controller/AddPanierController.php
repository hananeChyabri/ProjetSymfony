<?php

namespace App\Controller;

use doctrine;
use App\Entity\Plante;
use App\Entity\Commande;
use App\Entity\DetailCommande;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\PlanteRepository;





class AddPanierController extends AbstractController
{


    #[Route('/panier/add', name: 'panier_add_produit_plusieurs')]
    public function addProduitPlusieurs(

        Request $req,
        SessionInterface $session,
        PlanteRepository $repPlante
    ): Response {
        $id = $req->request->get('id'); // id du produit à rajouter pris du POST (name dans le form)
        $quantite = 1; // quantité, pris du POST (name dans le form)

        $panierCommande = $session->get('panierCommande', new Commande()); // si la variable 'panier' n'existe pas, on initialise l'array

        $detail = new DetailCommande();
        
        // new
        // rajouter le detail au produit
        $plante = $repPlante->find($id);
        

        $plante->addDetail($detail);

        $detail->setQuantite($quantite); // on fixe ici la quantité, mais quand on fait addDetail l'addition sera faite (regardez le code de addDetail dans l'entity Commande)

        // rajouter le detail à la commande dans la session        
        $panierCommande->addDetail($detail);  // regardez le code de addDetail       

        $session->set('panierCommande', $panierCommande);
      

        $rajoute = true;
    
       // return $this->redirectToRoute('panier_afficher');
       return new JsonResponse(['rajoute' => $rajoute], 200);
    }

    #[Route('/panier/afficher', name: 'panier_afficher')]
    public function index(SessionInterface $session): Response
    {
       
        $panierCommande = $session->get('panierCommande', new Commande());

        $vars = ['panierCommande' => $panierCommande];
        return $this->render('panier/panier_afficher.html.twig', $vars);
      
    }

        // efface un détail de la session
    // On cherche par l'id du produit du détail
    // On ne peut pas chercher par id de détail car
    // La commande n'est pas encore dans la BD
    // et les détails non plus (ils n'ont pas d'id)
    #[Route('/panier/effacer/detail/{id}', name: 'panier_effacer_detail')]
    public function panierEffacerDetail(
        Request $req,
        SessionInterface $session,
    ) {

        // dump ($session->get("panierCommande"));
        // dump ($detail);

        // on efface de la session et de la BD
        $panierCommande = $session->get("panierCommande");

        // Effacer de la SESSION
        // On cherche le détail qui contient le produit dans
        // la commande de la session
        
        // Commande avant
        // dump($panierCommande->getDetails());

        // on parcour tous les détails et on cherche 
        // celui qui contient le produit recherché
        $detailsCommandeSession = $panierCommande->getDetails();
        foreach ($panierCommande->getDetails() as $key => $detailSession){
            if ($req->get('id') == $detailSession->getPlante()->getId()){
                $detailsCommandeSession->removeElement($detailSession);
                // plus besoin de chercher, on redirige
                return $this->redirectToRoute('panier_afficher');

            }
        }
        // Commande après
        // dd($panierCommande->getDetails());

        // on affiche à nouveau le panier de toute façon
        return $this->redirectToRoute('panier_afficher');
    }
}


   

