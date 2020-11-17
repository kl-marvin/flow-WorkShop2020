<?php

namespace App\Form;

use App\Entity\BusinessHours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateBusinessHoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('openTime', null, [
                'label' => 'Horaires du matin ',
                'required' => true
            ])
            ->add('closeTime', null, [
                'label' => 'Horaires de l\'après-midi ',
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BusinessHours::class,
        ]);
    }
}
