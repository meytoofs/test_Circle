<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, [
                'required' => true,
                'label' => 'form_inscription.email',
                'attr' => [
                    'placeholder' => 'form_inscription.placeholder_email',
                ]
            ])
            ->add('pseudo', TextType::class, [
                'required' => true,
                'label' => 'form_inscription.pseudo',
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'form_inscription.agreeTerms',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'label' => true,
                'required' => true,
                'label' => 'form_inscription.password',
                'attr' => [
                    'placeholder' => 'form_inscription.placeholder_password',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'form_inscription.requiredPassword',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'form_inscription.passwordLength',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
