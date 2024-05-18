<?php

namespace App\Form;

use App\Entity\Dj;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DjType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom')
            ->add('Prenom')
            ->add('email')
            ->add('tel')
            ->add('portfolio')
            ->add('dateSoiree', null, [
                'widget' => 'single_text',
            ])
            ->add('hasMaterial')
            ->add('color')
            ->add('nbSpeaker')
            ->add('powerSpeaker')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dj::class,
        ]);
    }
}
