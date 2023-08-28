<?php

namespace App\DataFixtures;

use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VilleFixtures extends Fixture
{
    public const PARIS1 = "paris1";
    public const PARIS2 = "paris2";
    public const PARIS3 = "paris3";

    public function load(ObjectManager $manager): void
    {
        $ville = new Ville();
        $ville -> setLibelle("Paris 1");
        $manager->persist($ville);
        $this->addReference(self::PARIS1, $ville);


        $ville = new Ville();
        $ville -> setLibelle("Paris 2");
        $manager->persist($ville);
        $this->addReference(self::PARIS2, $ville);

        
        $ville = new Ville();
        $ville -> setLibelle("Paris 3");
        $manager->persist($ville);
        $this->addReference(self::PARIS3, $ville);


        $manager->flush();
    }
}
