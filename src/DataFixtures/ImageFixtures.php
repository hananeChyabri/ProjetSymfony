<?php

namespace App\DataFixtures;

use App\Entity\Plante;
use App\Entity\Image;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ImageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $repPlantes = $manager->getRepository(Plante::class);
        $Plantes = $repPlantes->findAll();

        for ($i = 1; $i < 4; $i++) {
            $image = new Image();
            $image->setUrl("images/plante" . $i . "jpg");

            //associer l'image a une plante
            $image->setPlante($Plantes[mt_rand(0, count($Plantes) - 1)]);
            $manager->persist($image);
        }
        $manager->flush();
    }


    public function getDependencies()
    {
        return ([
            PlanteFixtures::class,
            UserFixtures::class
        ]);
    }
}
