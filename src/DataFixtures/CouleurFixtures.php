<?php

namespace App\DataFixtures;

use App\Entity\Couleur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CouleurFixtures extends Fixture
{
    public const BLANC = "blanc";
    public const BLEU = "bleu";
    public const ROUGE = "rouge";
    public const JAUNE = "jaune";
    public const NOIR = "noir";

    public function load(ObjectManager $manager): void
    {
        $couleur = new Couleur();
        $couleur -> setLibelle("Blanc");
        $manager->persist($couleur);
        $this->addReference(self::BLANC, $couleur);

        $couleur = new Couleur();
        $couleur -> setLibelle("Bleu");
        $manager->persist($couleur);
        $this->addReference(self::BLEU, $couleur);

        $couleur = new Couleur();
        $couleur -> setLibelle("Rouge");
        $manager->persist($couleur);
        $this->addReference(self::ROUGE, $couleur);

        $couleur = new Couleur();
        $couleur -> setLibelle("Jaune");
        $manager->persist($couleur);
        $this->addReference(self::JAUNE, $couleur);

        $couleur = new Couleur();
        $couleur -> setLibelle("Noir");
        $manager->persist($couleur);
        $this->addReference(self::NOIR, $couleur);

        $manager->flush();
    }
}
