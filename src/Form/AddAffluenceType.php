<?php

namespace App\Form;

use App\Entity\Affluence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AddAffluenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numberOfPeople', null, [
                'label' => 'Nombre de visiteur',
                'required' => true
            ])
            ->add('StartTime', DateTimeType::class, [
                'label' => 'Début du créneau à traiter',
                'widget' => 'single_text',
                'required' => true
            ])
            ->add('endTime', DateTimeType::class, [
                'label' => 'Fin du créneau à traiter',
                'widget' => 'single_text',
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Affluence::class,
        ]);
    }
}
