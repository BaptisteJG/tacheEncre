<?php

namespace App\DataFixtures;

use App\Entity\EtatCommand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EtatCommandFixtures extends Fixture
{
    public const PREP = "preparation";
    public const RECUP = "recuperation";
    public const FIN = "recuperer";

    public function load(ObjectManager $manager): void
    {
        $etatCommand = new EtatCommand();
        $etatCommand->setEtatCommand('En Préparation');
        $manager->persist($etatCommand);
        $this->addReference(self::PREP, $etatCommand);

        $etatCommand = new EtatCommand();
        $etatCommand->setEtatCommand('A venir Récupérer');
        $manager->persist($etatCommand);
        $this->addReference(self::RECUP, $etatCommand);

        $etatCommand = new EtatCommand();
        $etatCommand->setEtatCommand('Récupérer');
        $manager->persist($etatCommand);
        $this->addReference(self::FIN, $etatCommand);

        $manager->flush();
    }
}
