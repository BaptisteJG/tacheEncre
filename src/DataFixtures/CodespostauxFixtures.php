<?php

namespace App\DataFixtures;

use App\Entity\Codespostaux;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CodespostauxFixtures extends Fixture
{
        public const CP75001 = "75001";
        public const CP75002 = "75002";
        public const CP75003 = "75003";

    public function load(ObjectManager $manager): void
    {
        $codespostaux = new Codespostaux();
        $codespostaux -> setNumero("75001");
        $manager->persist($codespostaux);
        $this->addReference(self::CP75001, $codespostaux);

        $codespostaux = new Codespostaux();
        $codespostaux -> setNumero("75002");
        $manager->persist($codespostaux);
        $this->addReference(self::CP75002, $codespostaux);
        
        
        $codespostaux = new Codespostaux();
        $codespostaux -> setNumero("75003");
        $manager->persist($codespostaux);
        $this->addReference(self::CP75003, $codespostaux);


        $manager->flush();
    }
}
