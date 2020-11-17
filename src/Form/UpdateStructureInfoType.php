<?php

namespace App\Form;

use App\Entity\Structure;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UpdateStructureInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('streetNumber', null, [
                'label' => 'Numéro de rue',
                'required' => true
            ])
            ->add('streetName', null, [
                'label' => 'Nom de rue',
                'required' => true
            ])
            ->add('city', null, [
                'label' => 'Ville',
                'required' => true
            ])
            ->add('zipCode', null, [
                'label' => 'Code Postal',
                'required' => true
            ])
            ->add('country', null, [
                'label' => 'Pays',
                'required' => true
            ])

            ->add('phone', null, [
                'label' => 'Téléphone',
                'required' => true
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Structure::class,
        ]);
    }
}
