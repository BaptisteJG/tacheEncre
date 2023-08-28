<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Ville;
use App\Entity\Adresse;
use App\Entity\Codespostaux;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un nom'
                    ])
                    ],
            ])
            ->remove('roles')
            ->remove('password')
            ->add('nom', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un nom'
                    ])
                    ],
            ])
            ->add('tel', null, [
                'label' => 'Téléphone',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un téléphone'
                    ])
                    ],
            ])
            
        ;

        // Si isCommand est false le mot de passe apparait mais dans le cas contraire il n'apparait pas
        if ($options['isCommand'] == false){
            $builder
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent être identiques.',
                'required' => false,
                'first_options' => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Confirmation du mot de passe'],
                'mapped' => false,
                'help' => 'Le mot de passe doit contenir 6 caractères minimum.'
            ])
            ->add('prenom')
            ->add('adresse', AdresseType::class, [])        // Permet imbriquer dans le formulaire le formulaire AdresseType
            ;
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            // Option pour faire apparaitre ou non un add
            'isCommand' => false,
        ]);
    }
}
