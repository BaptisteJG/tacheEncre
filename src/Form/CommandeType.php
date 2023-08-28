<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\EtatCommand;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir une date'
                    ])
                ]
            ])
            ->add('user', UserType::class, [
                'mapped' => false,
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
