<?php

namespace App\DataFixtures;

use App\Entity\Adresse;
use App\DataFixtures\VilleFixtures;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\CodespostauxFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AdresseFixtures extends Fixture implements DependentFixtureInterface
{
    public const LOUVRE = "louvre";
    public const BANQUE = "banque";
    public const EUGENE = "eugene";

    public function load(ObjectManager $manager): void
    {
        $adresse = new Adresse();
        $adresse -> setNumRue("40 rue du Louvre");
        $adresse -> setVille($this->getReference(VilleFixtures::PARIS1));
        $adresse -> setCodespostaux($this->getReference(CodespostauxFixtures::CP75001));
        $manager->persist($adresse);
        $this->addReference(self::LOUVRE, $adresse);


        $adresse = new Adresse();
        $adresse -> setNumRue("8 Rue de la Banque");
        $adresse -> setVille($this->getReference(VilleFixtures::PARIS2));
        $adresse -> setCodespostaux($this->getReference(CodespostauxFixtures::CP75002));
        $manager->persist($adresse);
        $this->addReference(self::BANQUE, $adresse);


        $adresse = new Adresse();
        $adresse -> setNumRue("2 Rue Eugène Spuller");
        $adresse -> setVille($this->getReference(VilleFixtures::PARIS3));
        $adresse -> setCodespostaux($this->getReference(CodespostauxFixtures::CP75003));
        $manager->persist($adresse);
        $this->addReference(self::EUGENE, $adresse);


        $manager->flush();
    }

    public function getDependencies()
    {
        return [VilleFixtures::class, CodespostauxFixtures::class];
    }
}
