<?php

namespace App\Form;

use App\Entity\Lead;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LeadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Lead Name',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('company', TextType::class, [
                'label' => 'Company Name',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('domain', TextType::class, [
                'label' => 'Domain',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('conversion_status', CheckboxType::class, [
                'label' => 'Conversion Status',
                'attr' => ['class' => 'form-control'],
                'required' => false
            ])
            ->add('broadcast_status', CheckboxType::class, [
                'label' => 'Broadcast Status',
                'attr' => ['class' => 'form-control'],
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lead::class,
        ]);
    }
}
