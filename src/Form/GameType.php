<?php

namespace App\Form;

use App\Entity\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('editeur')
            ->add('duration')
            ->add('nbJoueursMin')
            ->add('nbJoueursMax')
            ->add('age')
            ->add('image')
            ->add('shortDescription')
            ->add('longDescription')
            ->add('auteurs')
            ->add('dessinateurs')
            ->add('themes')
            ->add('types')
            ->add('users')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
