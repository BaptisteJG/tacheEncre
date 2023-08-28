<?php

namespace App\DataFixtures;

use App\Entity\Verre;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\FournisseurFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class VerreFixtures extends Fixture implements DependentFixtureInterface
{
    public const CLASSIQUE = "classique";
    public const ANTIUV = "anti-uv";


    public function load(ObjectManager $manager): void
    {
        $verre = new Verre();
        $verre -> setLibelle("Classique");
        $verre -> setFournisseur($this->getReference(FournisseurFixtures::SERVICE));
        $manager->persist($verre);
        $this->addReference(self::CLASSIQUE, $verre);


        $verre = new Verre();
        $verre -> setLibelle("Anti-UV");
        $verre -> setFournisseur($this->getReference(FournisseurFixtures::SERVICE));
        $manager->persist($verre);
        $this->addReference(self::ANTIUV, $verre);


        $manager->flush();
    }

    public function getDependencies()
    {
        return [FournisseurFixtures::class];
    }
}
