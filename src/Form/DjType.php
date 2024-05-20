<?php

namespace App\Form;

use App\Entity\Dj;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

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
            ->add('image', FileType::class, [
                'label' => 'Image (PNG or JPEG)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2048k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PNG or JPEG image',
                    ])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dj::class,
        ]);
    }
}
