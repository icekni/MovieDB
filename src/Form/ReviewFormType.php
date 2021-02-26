<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ReviewFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextareaType::class, [
                'label' => 'Message',
                'required' => true,
                'constraints' => [
                    // Non vide
                    new NotBlank(),
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'required' => true,
                'constraints' => [
                    // Non vide
                    new NotBlank(),
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'constraints' => [
                    // Non vide
                    new NotBlank(),
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => true,
                'constraints' => [
                    // Non vide
                    new NotBlank(),
                ]
            ])
            ->add('age', IntegerType::class, [
                'label' => 'age',
                'required' => true,
                'constraints' => [
                    // Non vide
                    new NotBlank(),
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password',
                'required' => true,
                'constraints' => [
                    // Non vide
                    new NotBlank(),
                ]
            ])
            ->add('url', UrlType::class, [
                'label' => 'Url',
                'required' => true,
                'constraints' => [
                    // Non vide
                    new NotBlank(),
                ]
            ])
            ->add('movie_id', HiddenType::class, [
                'required' => true,
                'constraints' => [
                    // Non vide
                    new NotBlank(),
                ]
            ])
            ->add('rating', ChoiceType::class, [
                'required' => true,
                'choices' => [
                    '*' => '1',
                    '**' => '2',
                    '***' => '3',
                    '****' => '4',
                    '*****' => '5'
                ],
                'constraints' => [
                    // Non vide
                    new NotBlank(),
                ]
            ])
            ->add('checkbox', CheckboxType::class, [
                'label' => 'Rire',
            ])
            ->add('date', DateTimeType::class, [
                'label' => 'Vous avez vu le film le',
                'required' => true,
                'constraints' => [
                    // Non vide
                    new NotBlank(),
                ]
            ])
            ->add('file', FileType::class, [
                'label' => 'Photo',
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
