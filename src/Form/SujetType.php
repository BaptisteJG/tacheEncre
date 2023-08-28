<?php

namespace App\Form;

use App\Entity\Sujet;
use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SujetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('formatSujet', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un format'
                    ])
                ]
            ])
            ->add('baguette')
            ->add('tailleBaguette')
            ->add('passePartout')
            ->add('taillePP', null, [
                'label' => 'Taille du Passe Partout',
            ])
            ->add('verre')
            ->add('tailleVerre')
            ->add('montantTotal', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un montant'
                    ])
                ]
            ])
            ->remove('accompte')
            
        ;

        if ($options['isSujet'] == false){
            $builder
                ->add('commande', EntityType::class, [
                    'class' => Commande::class,
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez saisir une commande',
                        ]),
                    ]
                ])
            ;
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sujet::class,
            'isSujet' => true,
        ]);
    }
}
