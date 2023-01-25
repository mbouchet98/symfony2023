<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('email', TextType::class, [
                'label' => 'Email Utilisateur',
                'required' => true,

            ])
            ->add('password', TextType::class, [
                'label' => 'Mot de passe de lutilisateur',
                'required' => true,

            ])
            ->add('Enregistrer',SubmitType::class)
            ->getForm()
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
