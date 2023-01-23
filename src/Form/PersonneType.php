<?php

namespace App\Form;

use App\Entity\Personne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonneType extends AbstractType
{

    public function __construct(Personne $personne = null)
    {
        $this->personne = $personne;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $nom = $options['existingPersonne'] ? $options['existingPersonne']->getNom() : null;
        $pernom = $options['existingPersonne'] ? $options['existingPersonne']->getPrenom() : null;
        $builder
            ->add('Nom', TextType::class, [
                'label' => 'Nom personne',
                'required' => true,
                'data' => $nom,
            ])
            ->add('Prenom', TextType::class, [
                'label' => 'Prenom personne',
                'required' => true,
                'data' => $pernom,
            ])
            ->add('Enregistrer', SubmitType::class)
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'existingPersonne' => Personne::class,
        ]);
    }
}
