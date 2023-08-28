<?php

namespace App\Form;

use App\Entity\Verre;
use App\Entity\Fournisseur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VerreType extends AbstractType
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
            'data_class' => Verre::class,
        ]);
    }
}
