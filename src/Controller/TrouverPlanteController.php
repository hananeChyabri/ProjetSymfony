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
use Knp\Component\Pager\PaginatorInterface;

class TrouverPlanteController extends AbstractController
{

    // Action qui affiche toutes les plantes

    #[Route('/plante/trouver_une_plante', name: 'maPlante')]
    public function RecherchePlantes(PaginatorInterface $paginator , Request $req, ManagerRegistry $doctrine, SerializerInterface $serializer): Response

    {

        $formulaireFiltrePlante = $this->createForm(FiltrePlanteType::class);

        $formulaireFiltrePlante->handleRequest($req);

        $user = $this->getUser();
        $numeroPage = $req->query->getInt('page', 1); 

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
                $arrPlante['like'] = false;
                if ($user)
                $arrPlante['like'] = $user->getPlantes()->contains($plante) ? true : false;
                


                $plantes[] = $arrPlante;
                $paginationPlante = $paginator->paginate(
                    $plantes,
                        $numeroPage,
                        5 // résultats affichés par page
                    );

            }
            $response = $serializer->serialize($paginationPlante, 'json');
            return new Response($response);
        } else {
            //chercher toutes les plantes dans la base de donnees
            $rep = $doctrine->getRepository(Plante::class);
            $resultatsPlantes = $rep->recherchePlanteFiltres();
          
        
            $paginationPlante = $paginator->paginate(
            $resultatsPlantes,
                $numeroPage,
                6 // résultats affichés par page
            );
            $vars = ['listePlantes' => $paginationPlante, 'form' => $formulaireFiltrePlante];
        }
    
   

        return $this->render('plante/trouver_une_plante.html.twig', $vars);
    }
}
