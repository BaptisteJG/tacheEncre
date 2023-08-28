<?php

namespace App\Form;

use App\Form\SujetType;
use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AjoutCommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', null, [
                'label' => 'Date de la commande',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir une date'
                    ])
                ]
            ])
            ->add('user', UserType::class, [
                'isCommand' => true,    // Option pour ne pas faire apparaitre le mot de passe ici
            ])
            ->add('prix')
            ->add('sujets', CollectionType::class, [
                'entry_type' => SujetType::class,
                // 'isSujet' => true,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}




// namespace App\Form;

// use App\Entity\Sujet;
// use App\Form\SujetType;
// use App\Form\CommandeType;
// use Symfony\Component\Form\AbstractType;
// use Symfony\Component\Form\FormBuilderInterface;
// use Symfony\Component\Validator\Constraints\NotBlank;
// use Symfony\Component\OptionsResolver\OptionsResolver;
// use Symfony\Component\Form\Extension\Core\Type\CollectionType;

// class AjoutCommandeType extends AbstractType
// {
//     public function buildForm(FormBuilderInterface $builder, array $options): void
//     {
//         $builder
//             ->add('commande', CommandeType::class, [
//             ])
            
//             // ->add('sujet', CollectionType::class, [
//             //     'entry_type' => SujetType::class,
//             //     'allow_add' => true,
//             //     'allow_delete' => true,
//             //     'by_reference' => false,
//             // ])
//             ->add('description')
//             ->add('formatSujet', null, [
//                 'constraints' => [
//                     new NotBlank([
//                         'message' => 'Veuillez saisir un format'
//                     ])
//                 ]
//             ])
//             ->add('baguette')
//             ->add('tailleBaguette')
//             ->add('passePartout')
//             ->add('taillePP', null, [
//                 'label' => 'Taille du Passe Partout',
//             ])
//             ->add('verre')
//             ->add('tailleVerre')
//             ->add('montantTotal', null, [
//                 'label' => 'Prix du sujet',
//                 'constraints' => [
//                     new NotBlank([
//                         'message' => 'Veuillez saisir un montant'
//                     ])
//                 ]
//             ])
//             ->remove('accompte')
            
//         ;
//     }

//     public function configureOptions(OptionsResolver $resolver): void
//     {
//         $resolver->setDefaults([
//             'data_class' => Sujet::class,
//         ]);
//     }
// }
