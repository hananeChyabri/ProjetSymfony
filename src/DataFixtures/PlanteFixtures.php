<?php

namespace App\DataFixtures;

use App\Entity\Plante;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PlanteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $sql = file_get_contents('DataFixtures/plante.sql');
        // $connection = $manager->getConnection();
        // $connection->executeQuery($sql);
        $faker = Factory::create('fr_FR');
        //type de feuillage
        $nomsPlantes = ['Rose', 'Tulipe', 'Lavande', 'Orchidée', 'Lilas', 'Hortensia', 'Monstera deliciosa', 'Pivoine', 'Aloe Vera', 'Fougère', 'Bonsaï', 'Bambou'];
        $typeFeuillage = array("Persistant", "Caduc");
        $familleBotanique = array("Rosacées", "Liliacées", "Orchidacées", "Oléacées", "Fabacées ou Légumineuses", "Solanacées", "Orchidacées", "Ericacées", "Cactacées", "Lauracées", "Poacées ou Orchidées", "Cucurbitacées", "Ranunculacées");
        $typePlante = array("Arbre", "Arbuste", "Plante ornementale", "Fruit", "Légume", "Aromatique", "Médicinale", "Plante de bassin");
        $lieuCultive = array("Intérieur", "Balcon ou terrasse", "Jardin", "Potager ou verger");
        $climat = array("Océanique", "Semi-océanique", "Montagnard", "Méditerranéen", "Continental");
        $exposition = array("Soleil", "Mi-ombre", "Ombre");
        $besoinEau = array("Faible", "Moyen", "Important");
        $niveauSoin = array("Facile", "Modéré", "Difficile");
        $resistanceFroid = array("Fragile", "À protéger", "Résistante");
        $natureTerre = array("Argileuse", "Caillouteuse ", "Calcaire", "Humifère", "Sableuse", "Terre de bruyère", "Terreau ");
        $humiditeSol = array("Sec", "Drainé", "Frais", "Humide");
        $phSol = array("Alcalin ", "Neutre", "Acide ");
        $croissance = array("Lente", "Normale", "Rapide");

        for ($i = 0; $i < 11; $i++) {
            $plante = new Plante(
                [
                    'nom' => $nomsPlantes[$i],
                    'familleBotanique' => $familleBotanique[mt_rand(0, count($familleBotanique) - 1)],
                    'origin' => $faker->country(),
                    'typeDeFeuillage' => $typeFeuillage[mt_rand(0, count($typeFeuillage) - 1)],
                    'frequenceArrosage' => mt_rand(0, 3),
                    'tailleMature' => mt_rand(1000, 30000) / 100.0,
                    'periodeFloraison' => $faker->month,
                    'utilisation' => "decoration",
                    'lieuCultive' => $lieuCultive[mt_rand(0, count($lieuCultive) - 1)],
                    'couleurFleur' => $faker->colorName(),
                    'climat' => $climat[mt_rand(0, count($climat) - 1)],
                    'exposition' => $exposition[mt_rand(0, count($exposition) - 1)],
                    'besoinEau' => $besoinEau[mt_rand(0, count($besoinEau) - 1)],
                    'resistanceFroid' => $resistanceFroid[mt_rand(0, count($resistanceFroid) - 1)],
                    'niveauSoin' => $niveauSoin[mt_rand(0, count($niveauSoin) - 1)],
                    'natureTerre' => $natureTerre[mt_rand(0, count($natureTerre) - 1)],
                    'humiditeSol' => $humiditeSol[mt_rand(0, count($humiditeSol) - 1)],
                    'phSol' => $phSol[mt_rand(0, count($phSol) - 1)],
                    'croissance' => $croissance[mt_rand(0, count($croissance) - 1)],
                    'description' => "Une plante à l'allure très tendance et qui prendra une place prépondérante dans votre intérieur avec ses grandes feuilles. La plante était particulièrement populaire dans les années 70. Elle nous revient en force. 

                    La plante est originaire d'Amérique du Sud et Centrale où elle peut grimper à des mètres de hauteur dans les arbres grâce à ses lianes. Ses feuilles peuvent quant à elles atteindre jusqu'à un mètre de large! C'est plutôt impressionnant si vous pouvez l'observer de vos yeux. La plante porte aussi de longs fruits avec une saveur tropicale unique. Une véritable explosion de saveur en bouche! Il est dommage que ces fruits soient absents sur la plante d'intérieur. J'aurais bien voulu y goûter moi-même...  ",
                    'typePlante' => $typePlante[mt_rand(0, count($typePlante) - 1)],


                ]
            );
            $manager->persist($plante);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return ([
            PlanteFixtures::class,
            ImageFixtures::class
        ]);
    }
}
