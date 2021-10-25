<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Length;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('author', TextType::class, [
                'constraints' => [
                    New NotBlank([
                        'message' => 'veuillez entrer votre nom s\'il vous plait',
                    ]),
                    New Length([
                        'min' => 2,
                        'minMessage' => 'Le nom de l\'auteur doit être composé de {{ limit }} charactères minimum '
                    ])
                ]
            ])
            ->add('content', TextareaType::class, [
                'constraints' => [
                    New NotBlank([
                        'message' => 'veuillez entrer un commentaire s\'il vous plait',
                    ]),
                    New Length([
                        'min' => 10,
                        'minMessage' => 'Votre description doit être composé d\'au moins {{ limit }} charactères',
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
