<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\DataFixtures\AdresseFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder; // Pour le hashage du mot de passe

    public const HARRY = "harry";
    public const RON = "ron";
    
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user -> setEmail("123@test.fr");
        $user->setRoles(["ROLE_USER", "ROLE_ADMIN"]);
        $user -> setPassword($this->encoder->hashPassword($user, "pass"));
        $user -> setNom("Potter");
        $user -> setPrenom("Harry");
        $user -> setTel('0100000000');
        $user -> setAdresse($this->getReference(AdresseFixtures::LOUVRE));
        $manager->persist($user);
        $this->addReference(self::HARRY, $user);

        $user = new User();
        $user -> setEmail("456@test.fr");
        $user->setRoles(["ROLE_USER"]);
        $user -> setPassword($this->encoder->hashPassword($user, "pass"));
        $user -> setNom("Weasley");
        $user -> setPrenom("Ron");
        $user -> setTel('0100000000');
        $user -> setAdresse($this->getReference(AdresseFixtures::BANQUE));
        $manager->persist($user);
        $this->addReference(self::RON, $user);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [AdresseFixtures::class];
    }
}
