<?php

namespace App\Form;

use App\Entity\Localisation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
// use App\Entity\Service;
// use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class LocalisationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('site_name')
            ->add('city')
            ->add('address')
        //     ->add('service', EntityType::class, [
        //     'class' => Service::class,
        //     'choice_label' => 'name', // ou un autre champ parlant
        //     'multiple' => true,
        //     'expanded' => false, // true si tu veux des cases à cocher
        //     'by_reference' => false,
        //     'label' => 'Services associés',
        // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Localisation::class,
        ]);
    }
}
