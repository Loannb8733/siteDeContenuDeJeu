<?php

namespace App\Form;

use App\Entity\News;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class NewsType extends AbstractType
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
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title',
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => News::class,
        ]);
    }
}
