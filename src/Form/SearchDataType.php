<?php

namespace App\Form;

use App\Data\SearchData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class SearchDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('q', TextType::class, [
            'label' => false,
            'required' => false,
            'attr' => [
                'placeholder' => 'form_search.placeholder'
            ]
        ])
        ->add('min', NumberType::class, [
            'label' => false,
            'required' => false,
            'attr' => [
                'placeholder' => 'min'
            ]
        ])
        ->add('max', NumberType::class, [
            'label' => false,
            'required' => false,
            'attr' => [
                'placeholder' => 'max'
            ]
        ])
        ->add('tri', CheckboxType::class, [
            'required' => false,
            'label' => 'form_search.tri',
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
