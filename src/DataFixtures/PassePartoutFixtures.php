<?php

namespace App\DataFixtures;

use App\Entity\PassePartout;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PassePartoutFixtures extends Fixture implements DependentFixtureInterface
{
    public const PP100 = "pp100";

    public function load(ObjectManager $manager): void
    {
        $pp = new PassePartout();
        $pp -> setLibelle("PP100");
        $pp -> setCouleur($this->getReference(CouleurFixtures::BLANC));
        $pp -> setFournisseur($this->getReference(FournisseurFixtures::SERVICE));
        $manager->persist($pp);
        $this->addReference(self::PP100, $pp);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [FournisseurFixtures::class];
    }
}
