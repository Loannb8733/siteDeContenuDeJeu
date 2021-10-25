<?php

namespace App\Form;

use App\Entity\FunnyStuffs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FunnyStuffsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'constraints' => [
                    New NotBlank([
                        'message' => 'veuillez entrer un titre s\'il vous plait',
                    ]),

                    New Length([
                        'min' => 10,
                        'minMessage' => 'Votre titre doit être composé d\'au moins {{ limit }} charactères',
                        // max length allowed by Symfony for security reasons
                        'max' => 100,
                    ])
                ]
            ])
            ->add('content', TextareaType::class, [
                'constraints' => [
                    New NotBlank([
                        'message' => 'veuillez entrer une description s\'il vous plait',
                    ]),
    
                    New Length([
                        'min' => 10,
                        'minMessage' => 'Votre description doit être composé d\'au moins {{ limit }} charactères',
                        // max length allowed by Symfony for security reasons
                    ])
                ]
            ])
            ->add('video', UrlType::class, [
                'constraints' => [
                    New NotBlank([
                        'message' => 'veuillez entrer une URL s\'il vous plait',
                    ]),
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FunnyStuffs::class,
        ]);
    }
}
