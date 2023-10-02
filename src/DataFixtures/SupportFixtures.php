<?php

namespace App\DataFixtures;

use App\Entity\Support;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SupportFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $support = new Support();
        $support -> setTitre("Conditions Générales d'Utilisation (CGU) - Site Web");
        $support -> setText("Date de la dernière mise à jour : 02/10/2023

        1. Acceptation des CGU
        
        En utilisant ce site web, vous acceptez de vous conformer à ces Conditions Générales d'Utilisation. Si vous n'acceptez pas ces conditions, veuillez ne pas utiliser ce site.
        
        2. Description des Services
        
        Ce site web propose des services d'encadrement personnalisé pour des œuvres d'art, de photographies, de diplômes, etc. L'encadreur s'engage à fournir des services de haute qualité conformément aux spécifications et aux exigences convenues avec le client.
        
        3. Commandes et Paiements
        
        a. Le client peut passer des commandes via ce site web en fournissant les informations nécessaires. Le paiement doit être effectué conformément aux tarifs et aux modalités de paiement convenus.
        
        b. Toutes les commandes sont sujettes à la disponibilité des matériaux et des ressources nécessaires à l'encadrement.
        
        c. Les tarifs et les frais de livraison sont indiqués sur le site web et peuvent être modifiés périodiquement.
        
        4. Politique de Confidentialité
        
        Toutes les informations fournies par les utilisateurs sont soumises à notre Politique de Confidentialité, qui régit la collecte, l'utilisation et la divulgation de vos données personnelles.
        
        5. Propriété Intellectuelle
        
        a. Tous les contenus, y compris les images, les textes et les vidéos, présents sur ce site web sont protégés par les lois sur la propriété intellectuelle. Vous vous engagez à respecter ces droits de propriété intellectuelle.
        
        b. Les utilisateurs peuvent télécharger du contenu uniquement pour un usage personnel et non commercial.
        
        6. Responsabilité
        
        a. L'encadreur s'engage à fournir des services de qualité, mais il ne peut garantir la perfection des produits finis en raison de la nature artisanale de l'encadrement.
        
        b. L'encadreur ne sera pas responsable des dommages indirects, des pertes de profits ou de la perte de données découlant de l'utilisation du site ou des services.
        
        7. Modifications des CGU
        
        L'encadreur se réserve le droit de modifier ces CGU à tout moment. Les utilisateurs seront informés des modifications par le biais du site web. Il est de votre responsabilité de consulter régulièrement les CGU mises à jour.
        
        8. Résiliation
        
        L'encadreur se réserve le droit de mettre fin à votre accès au site web en cas de violation de ces CGU ou de comportement inapproprié.
        
        9. Droit Applicable et Juridiction
        
        Ces CGU sont régies par les lois applicables de [votre pays]. Tout litige découlant de ces CGU sera soumis à la juridiction exclusive des tribunaux compétents de [votre ville/pays].
        
        10. Contact
        
        Pour toute question ou préoccupation concernant ces CGU, veuillez nous contacter à [adresse e-mail de contact].
        
        Ces conditions générales d'utilisation sont un exemple de base et doivent être adaptées en fonction des spécificités de votre site web et de votre activité d'encadreur. Il est recommandé de consulter un avocat ou un professionnel juridique pour vous assurer que vos CGU sont conformes à la législation en vigueur dans votre pays.");
        $manager->persist($support);

        $support = new Support();
        $support -> setTitre("Mot de l'encadreur");
        $support -> setText("Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores ut delectus sequi illo similique ducimus, eveniet nihil labore. Provident voluptas obcaecati voluptate praesentium sapiente corrupti laboriosam deleniti maxime quos fugit!
        Similique, mollitia quidem ullam magni voluptatibus totam illum, a earum reiciendis provident quos, ab saepe at praesentium vero. Sed dolores, in nesciunt magnam itaque quas voluptas aliquam consectetur aut deleniti.
        Earum impedit fugiat magni nobis cum fugit repudiandae quae exercitationem accusantium soluta laudantium enim nesciunt qui ad voluptate sed perspiciatis reiciendis sunt ducimus, quam harum doloremque voluptatem ipsa rerum. Odit!");
        $manager -> persist($support);

        $manager->flush();
    }
}
