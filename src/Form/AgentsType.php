<?php

namespace App\Form;

use App\Entity\Agents;
use App\Entity\Phone;
use App\Entity\Service;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('name')
            // ->add('firstname')
            // ->add('service', EntityType::class, [
            //     'class' => Service::class,
            //     'choice_label' => 'id',
            // ])
            // ->add('phone', EntityType::class, [
            //     'class' => Phone::class,
            //     'choice_label' => 'id',
            // ])
                        ->add('name', null, [
                'label' => 'Nom de l’agent',
                'attr' => ['placeholder' => 'Nom de famille']
            ])
            ->add('firstname', null, [
                'label' => 'Prénom de l’agent',
                'attr' => ['placeholder' => 'Prénom']
            ])
            ->add('service', EntityType::class, [
                'class' => Service::class,
                'choice_label' => function (Service $service) {
                    return $service->getName();
                },
                'placeholder' => '— Sélectionner un service —',
                'required' => false,
            ])
            ->add('phone', EntityType::class, [
                'class' => Phone::class,
                'choice_label' => function (Phone $phone) {
                    return $phone->getType() . ' - ' . $phone->getNumber();
                },
                'placeholder' => '— Sélectionner un numéro —',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Agents::class,
        ]);
    }
}
