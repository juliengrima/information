<?php

namespace App\Form;

use App\Entity\Agents;
use App\Entity\Localisation;
use App\Entity\Phone;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type')
            ->add('number', null, [
                'attr' => ['placeholder' => 'Ex: 0612345678'],
            ])
            ->add('localisation', EntityType::class, [
                'class' => Localisation::class,
                'choice_label' => 'siteName',
                'placeholder' => '— Choisir une localisation —',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Phone::class,
        ]);
    }
}
