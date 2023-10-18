<?php

namespace App\Form;

use App\Form\SujetType;
use App\Entity\Commande;
use App\Entity\EtatCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AjoutCommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'attr' => [
                    'class' => 'js-datepicker',
                    'placeholder' => 'JJ-MM-AAAA',
                ],
                'label' => 'Date de la commande',
                'format' => 'dd-MM-yyyy',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir une date'
                    ])
                ]
            ])
            ->add('user', UserType::class, [
                'label' => false,
                'isCommand' => true,    // Option pour ne pas faire apparaitre le mot de passe ici
            ])
            ->add('prix')
            ->add('etatCommand', EntityType::class, [
                'class' => EtatCommand::class,
                'choice_label' => 'etatCommand',
                'placeholder' => 'Selectionner l\'état de la commande',
                'expanded' => true,
                'label' => 'Etat de la commande',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un état'
                    ])
                ]    
            ])
            ->add('sujets', CollectionType::class, [
                'entry_type' => SujetType::class,
                // 'isSujet' => true,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
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
