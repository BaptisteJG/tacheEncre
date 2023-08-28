<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Codespostaux;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('num_rue', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir une rue'
                    ])
                ]
            ])
            ->add('ville', EntityType::class, [
                'class' => Ville::class,
                // 'constraints' => [
                //     new NotBlank([
                //         'message' => 'Veuillez saisir une ville'
                //     ])
                // ]
            ])
            ->add('newVille', TextType::class, [
                'required' => false,
                'mapped' => false,
            ])
            ->add('codespostaux', EntityType::class, [
                'class' => Codespostaux::class,
                // 'constraints' => [
                //     new NotBlank([
                //         'message' => 'Veuillez saisir un code postal'
                //     ])
                // ]
            ])
            ->add('newCP', TextType::class, [
                'required' => false,
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
