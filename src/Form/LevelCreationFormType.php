<?php

namespace App\Form;

use App\Entity\Level;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LevelCreationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => true,
                'required' => true,
                'label' => 'level_creation.title'
            ])
            ->add('content', TextareaType::class, [
                'label' => true,
                'required' => true,
                'label' => 'level_creation.content',
                'attr' => [
                    'placeholder' => 'level_creation.content_placeholder'
                ]
            ])
            ->add('Spritesheet', TextType::class, [
                'label' => 'level_creation.spritesheet',
                'attr' => [
                    'placeholder' => 'level_creation.spritesheet_placeholder'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Level::class,
        ]);
    }
}
