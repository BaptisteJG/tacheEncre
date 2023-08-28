<?php

namespace App\Form;

use App\Entity\Couleur;
use App\Entity\Baguette;
use App\Entity\Fournisseur;
use App\Entity\TypesCadres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BaguetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle',null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un nom'
                    ])
                ]
            ])
            ->add('typesCadres', EntityType::class, [ 
                'class' => TypesCadres::class,
                'choice_label' => 'libelle',
                'placeholder' => 'Selectionner un type de cadre',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un Type de cadre'
                    ])
                ]
            ])
            ->add('matiere', null, [
                'multiple' => true,
                'choice_label' => 'libelle',
                'multiple' => true,
                'expanded' => true,
                'constraints' => [
                    new Count([
                        'min' => 1,
                        'minMessage' => 'Veuillez sélectionner au moins une matière'
                    ])
                ]
            ])
            ->add('couleur', EntityType::class, [ 
                'class' => Couleur::class,
                'choice_label' => 'libelle',
                'placeholder' => 'Selectionner une couleur',
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
            'data_class' => Baguette::class,
        ]);
    }
}
