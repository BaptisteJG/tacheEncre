<?php

namespace App\Form;

use App\Entity\Couleur;
use App\Entity\Fournisseur;
use App\Entity\PassePartout;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PassePartoutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un nom'
                    ])
                ]
            ])
            ->add('couleur', EntityType::class, [ 
                'class' => Couleur::class,
                'choice_label' => 'libelle',
                'placeholder' => 'Selectionner une couleur',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un fournisseur'
                    ])
                ]
            ])
            ->add('fournisseur',EntityType::class, [ 
                'class' => Fournisseur::class,
                'choice_label' => 'nom',
                'placeholder' => 'Selectionner un fournisseur',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un fournisseur'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PassePartout::class,
        ]);
    }
}
