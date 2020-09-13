<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
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
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'form_inscription.email'
                ]
            ])
            ->add('pseudo', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'form_inscription.username'
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Your password should be at least {{ limit }} characters',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                            ]),
                        ],
                        'first_options'  => ['label' => 'Password',
                        'attr' => [
                            'placeholder' => 'form_inscription.password'
                        ]
                        ],
                        'second_options' => ['label' => 'Repeat Password',
                        'attr' => [
                            'placeholder' => 'form_inscription.password_confirm'
                        ]
                        ],
                        ])
                        ->add('first_name', TextType::class, [
                            'attr' => [
                                'placeholder' => 'form_inscription.firstname'
                            ]
                        ])
                        ->add('last_name', TextType::class, [
                            'attr' => [
                                'placeholder' => 'form_inscription.lastname'
                            ]
                        ])
                        ->add('telephone', TelType::class, [
                            'attr' => [
                                'placeholder' => 'Telephone'
                            ]
                        ])
                        ->add('adress', TextType::class, [
                            'attr' => [
                                'placeholder' => 'form_inscription.adress'
                            ]
                        ])
                        ->add('agreeTerms', CheckboxType::class, [
                            'mapped' => false,
                            'constraints' => [
                                new IsTrue([
                                    'message' => 'Avez vous plus de 13',
                                ]),
                            ],
                        ])
                        ->add('save', SubmitType::class, [
                            'attr' => [
                                'value' => 'Enregistrer'
                            ]
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
