<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\EtatCommand;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
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
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir une date'
                    ])
                    ],
                'format' => 'ddMMyyyy',
                
            ])
            ->add('user', UserType::class, [
                'label' => false,
                'mapped' => false,
                'isCommand' => true,    // Option pour ne pas faire apparaitre le mot de passe ici
            ])
            ->add('prix')
            ->add('etatCommand', EntityType::class, [
                'class' => EtatCommand::class,
                'choice_label' => 'etatCommand',
                'expanded' => true,
                'label' => 'Etat de la commande',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un état'
                    ])
                    ],
                // 'data' => $options["default_etatCommand"],   // Case cocher par défaut
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
