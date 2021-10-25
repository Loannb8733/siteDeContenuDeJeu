<?php

namespace App\Form;

use App\Entity\RecentGame;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class RecentGameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    New NotBlank([
                        'message' => 'veuillez entrer nom de jeu s\'il vous plait',
                    ]),

                    New Length([
                        'min' => 2,
                        'minMessage' => 'Le nom du jeu doit être composé d\'au moins {{ limit }} charactères',
                    ])
                ]
            ])
            ->add('platform', TextType::class, [
                'constraints' => [
                    New NotBlank([
                        'message' => 'veuillez entrer une plateforme s\'il vous plait',
                    ]),

                    New Length([
                        'min' => 2,
                        'minMessage' => 'Le nom de la plateforme doit être composé d\'au moins {{ limit }} charactères',
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
                    ])
                ]
            ]) 
            ->add('image', UrlType::class)
            ->add('videos', UrlType::class)
            ->add('releaseDate', TextType::class, [
                  'constraints' => [
                    New NotBlank([
                        'message' => 'veuillez entrer une date s\'il vous plait',
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RecentGame::class,
        ]);
    }
}
