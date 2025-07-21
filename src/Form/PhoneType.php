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
            ->add('number')
            // ->add('localistaion', EntityType::class, [
            //     'class' => Localisation::class,
            //     'choice_label' => 'id',
            // ])
            ->add('localisation', EntityType::class, [
                'class' => Localisation::class,
                'choice_label' => 'siteName',
                'placeholder' => '— Choisir une localisation —',
                'required' => false,
            ])
            // ->add('agents', EntityType::class, [
            //     'class' => Agents::class,
            //     'choice_label' => 'fullName', // ou un autre champ pertinent
            //     'placeholder' => '— Sélectionner un agent —',
            //     'required' => false,
            // ])
            ->add('agents', EntityType::class, [
                'class' => Agents::class,
                'choice_label' => function (Agents $agent) {
                    return $agent->getFirstname() . ' ' . $agent->getName();
                },
                'placeholder' => '— Sélectionner un agent —',
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
