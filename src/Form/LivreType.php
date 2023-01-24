<?php

namespace App\Form;

use App\Entity\Edition;
use App\Entity\Livre;
use App\Entity\Personne;
use Symfony\Bridge\Doctrine\Form\Type\EntitiesType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $nomLivre = $options['existingLivre'] ? $options['existingLivre']->getNomLivre() : null;
        $resumer = $options['existingLivre'] ? $options['existingLivre']->getResumerLivre() : null;
        $builder
            ->add('nomLivre', TextType::class, [
                'label' => 'Titre dy livre',
                'required' => true,
                'data' => $nomLivre,
            ])
            ->add('resumerLivre', TextareaType::class, [
                'label' => 'Résumer du livre',
                'required' => true,
                'data' => $resumer,
            ])
            ->add('edition', EntityType::class, [
                'class' => Edition::class,
                'choice_label' => 'nomEdition',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('personnes', EntityType::class, [
                'class' => Personne::class,
                'choice_label' => 'nomEtPrenom',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('Enregistrer', SubmitType::class)
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'existingLivre' => Livre::class,
        ]);
    }
}
