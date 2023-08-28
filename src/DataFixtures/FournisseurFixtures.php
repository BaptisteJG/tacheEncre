<?php

namespace App\DataFixtures;

use App\Entity\Fournisseur;
use App\DataFixtures\AdresseFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class FournisseurFixtures extends Fixture implements DependentFixtureInterface
{
    public const SERVICE = "service";

    public function load(ObjectManager $manager): void
    {
        $fournisseur = new Fournisseur();
        $fournisseur -> setNom("BaguetteService");
        $fournisseur -> setTel("0200000000");
        $fournisseur -> setEmail("fourn@test.fr");
        $fournisseur -> setAdresse($this->getReference(AdresseFixtures::EUGENE));
        $manager->persist($fournisseur);
        $this->addReference(self::SERVICE, $fournisseur);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [AdresseFixtures::class];
    }
}
