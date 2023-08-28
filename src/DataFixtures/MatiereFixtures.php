<?php

namespace App\DataFixtures;

use App\Entity\Matiere;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MatiereFixtures extends Fixture
{
    public const CHENE = "chene";
    public const NOYER = "noyer";

    public function load(ObjectManager $manager): void
    {
        $matiere = new Matiere();
        $matiere -> setLibelle("Chêne");
        $manager->persist($matiere);
        $this->addReference(self::CHENE, $matiere);

        $matiere = new Matiere();
        $matiere -> setLibelle("Noyer");
        $manager->persist($matiere);
        $this->addReference(self::NOYER, $matiere);

        $manager->flush();
    }
}
