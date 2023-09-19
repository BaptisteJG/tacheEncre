<?php

namespace App\DataFixtures;

use App\Entity\Baguette;
use App\DataFixtures\CouleurFixtures;
use App\DataFixtures\MatiereFixtures;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\FournisseurFixtures;
use App\DataFixtures\TypesCadresFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BaguetteFixtures extends Fixture implements DependentFixtureInterface
{
    public const REF0101 = "ref0101";

    public function load(ObjectManager $manager): void
    {
        $baguette = new Baguette();
        $baguette -> setLibelle("REF0101");
        $baguette -> setTypesCadres($this->getReference(TypesCadresFixtures::PLAT));
        $baguette -> setCouleur($this->getReference(CouleurFixtures::NOIR));
        $baguette -> addMatiere($this->getReference(MatiereFixtures::CHENE));
        $baguette -> setFournisseur($this->getReference(FournisseurFixtures::SERVICE));
        $manager->persist($baguette);
        $this->addReference(self::REF0101, $baguette);

        $baguette = new Baguette();
        $baguette -> setLibelle("REF0102");
        $baguette -> setTypesCadres($this->getReference(TypesCadresFixtures::PLAT));
        $baguette -> setCouleur($this->getReference(CouleurFixtures::NOIR));
        $baguette -> addMatiere($this->getReference(MatiereFixtures::CHENE));
        $baguette -> setFournisseur($this->getReference(FournisseurFixtures::SERVICE));
        $manager->persist($baguette);

        $baguette = new Baguette();
        $baguette -> setLibelle("REF0103");
        $baguette -> setTypesCadres($this->getReference(TypesCadresFixtures::PLAT));
        $baguette -> setCouleur($this->getReference(CouleurFixtures::NOIR));
        $baguette -> addMatiere($this->getReference(MatiereFixtures::CHENE));
        $baguette -> setFournisseur($this->getReference(FournisseurFixtures::SERVICE));
        $manager->persist($baguette);

        $baguette = new Baguette();
        $baguette -> setLibelle("REF0104");
        $baguette -> setTypesCadres($this->getReference(TypesCadresFixtures::PLAT));
        $baguette -> setCouleur($this->getReference(CouleurFixtures::NOIR));
        $baguette -> addMatiere($this->getReference(MatiereFixtures::CHENE));
        $baguette -> setFournisseur($this->getReference(FournisseurFixtures::SERVICE));
        $manager->persist($baguette);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [TypesCadresFixtures::class, CouleurFixtures::class, MatiereFixtures::class,FournisseurFixtures::class];
    }
}
