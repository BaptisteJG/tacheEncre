<?php

namespace App\DataFixtures;

use App\Entity\Sujet;
use App\DataFixtures\BaguetteFixtures;
use App\DataFixtures\CommandeFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SujetFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $sujet = new Sujet();
        $sujet -> setCommande($this->getReference(CommandeFixtures::D11));
        $sujet -> setDescription("Photo");
        $sujet -> setFormatSujet("21*29");
        $sujet -> setBaguette($this->getReference(BaguetteFixtures::REF0101));
        $sujet -> setTailleBaguette("28.8*30.8");
        $sujet -> setPassePartout($this->getReference(PassePartoutFixtures::PP100));
        $sujet -> setTaillePP("20,8*28,8 22,8*30,8");
        $sujet -> setVerre($this->getReference(VerreFixtures::CLASSIQUE));
        $sujet -> setTailleVerre("28.8*30.8");
        $sujet -> setMontantTotal(100);
        $sujet -> setAccompte(20);
        $manager->persist($sujet);

        $sujet = new Sujet();
        $sujet -> setCommande($this->getReference(CommandeFixtures::D20));
        $sujet -> setDescription("Peinture");
        $sujet -> setFormatSujet("30*59");
        $sujet -> setBaguette($this->getReference(BaguetteFixtures::REF0101));
        $sujet -> setTailleBaguette("30*59");;
        $sujet -> setMontantTotal(60);
        $manager->persist($sujet);

        $sujet = new Sujet();
        $sujet -> setCommande($this->getReference(CommandeFixtures::D18));
        $sujet -> setDescription("Poster1");
        $sujet -> setFormatSujet("70*100");
        $sujet -> setBaguette($this->getReference(BaguetteFixtures::REF0101));
        $sujet -> setTailleBaguette("75*105");
        $sujet -> setPassePartout($this->getReference(PassePartoutFixtures::PP100));
        $sujet -> setTaillePP("70*100 75*105");
        $sujet -> setVerre($this->getReference(VerreFixtures::ANTIUV));
        $sujet -> setTailleVerre("75*105");
        $sujet -> setMontantTotal(150);
        $manager->persist($sujet);

        $sujet = new Sujet();
        $sujet -> setCommande($this->getReference(CommandeFixtures::D18));
        $sujet -> setDescription("Poster2");
        $sujet -> setFormatSujet("70*100");
        $sujet -> setBaguette($this->getReference(BaguetteFixtures::REF0101));
        $sujet -> setTailleBaguette("75*105");
        $sujet -> setPassePartout($this->getReference(PassePartoutFixtures::PP100));
        $sujet -> setTaillePP("70*100 75*105");
        $sujet -> setVerre($this->getReference(VerreFixtures::ANTIUV));
        $sujet -> setTailleVerre("75*105");
        $sujet -> setMontantTotal(150);
        $manager->persist($sujet);

        $sujet = new Sujet();
        $sujet -> setCommande($this->getReference(CommandeFixtures::D202));
        $sujet -> setDescription("Poster");
        $sujet -> setFormatSujet("70*100");
        $sujet -> setBaguette($this->getReference(BaguetteFixtures::REF0101));
        $sujet -> setTailleBaguette("75*105");
        $sujet -> setPassePartout($this->getReference(PassePartoutFixtures::PP100));
        $sujet -> setTaillePP("70*100 75*105");
        $sujet -> setVerre($this->getReference(VerreFixtures::CLASSIQUE));
        $sujet -> setTailleVerre("75*105");
        $sujet -> setMontantTotal(100);
        $manager->persist($sujet);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [VerreFixtures::class];
    }
}
