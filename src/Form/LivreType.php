<?php

namespace App\Form;

use App\Entity\Edition;
use App\Entity\Livre;
use Symfony\Bridge\Doctrine\Form\Type\EntitiesType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
            ->add('resumerLivre', TextType::class, [
                'label' => 'Résumer du livre',
                'required' => true,
                'data' => $resumer,
            ])
            ->add('editions', EntityType::class, [
                'class' => Edition::class,
                'choice_label' => 'nomEdition',
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
