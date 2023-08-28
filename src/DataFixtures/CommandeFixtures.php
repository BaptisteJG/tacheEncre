<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Commande;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CommandeFixtures extends Fixture implements DependentFixtureInterface
{
    public const D11 = "11/08/2023";
    public const D20 = "20/08/2023";
    public const D18 = "18/08/2023";
    public const D202 = "20 aout 2023";


    public function load(ObjectManager $manager): void
    {
        $commande = new Commande();
        $commande -> setDate(new DateTime('2023/11/08'));
        $commande -> setUser($this->getReference(UserFixtures::RON));
        $commande -> setPrix(100);
        $commande -> setEtatCommand($this->getReference(EtatCommandFixtures::PREP));
        $manager->persist($commande);
        $this->addReference(self::D11, $commande);

        $commande = new Commande();
        $commande -> setDate(new DateTime('2023/08/20'));
        $commande -> setUser($this->getReference(UserFixtures::RON));
        $commande -> setPrix(60);
        $commande -> setEtatCommand($this->getReference(EtatCommandFixtures::RECUP));
        $manager->persist($commande);
        $this->addReference(self::D20, $commande);

        $commande = new Commande();
        $commande -> setDate(new DateTime('2023/08/18'));
        $commande -> setUser($this->getReference(UserFixtures::RON));
        $commande -> setPrix(300);
        $commande -> setEtatCommand($this->getReference(EtatCommandFixtures::FIN));
        $manager->persist($commande);
        $this->addReference(self::D18, $commande);

        $commande = new Commande();
        $commande -> setDate(new DateTime('2023/08/20'));
        $commande -> setUser($this->getReference(UserFixtures::HARRY));
        $commande -> setPrix(100);
        $commande -> setEtatCommand($this->getReference(EtatCommandFixtures::PREP));
        $manager->persist($commande);
        $this->addReference(self::D202, $commande);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}
