<?php

namespace App\DataFixtures;

use App\Entity\TypesCadres;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypesCadresFixtures extends Fixture
{
    public const CAISSE = "caisse";
    public const METAL = "metal";
    public const PLAT = "plat";

    public function load(ObjectManager $manager): void
    {
        $typec = new TypesCadres();
        $typec -> setLibelle("Caisse Americaine");
        $manager->persist($typec);
        $this->addReference(self::CAISSE, $typec);

        $typec = new TypesCadres();
        $typec -> setLibelle("Métal");
        $manager->persist($typec);
        $this->addReference(self::METAL, $typec);

        $typec = new TypesCadres();
        $typec -> setLibelle("Plat 2");
        $manager->persist($typec);
        $this->addReference(self::PLAT, $typec);

        $manager->flush();
    }
}
