<?php

namespace App\Form;

use App\Entity\Media;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'required' => true,
                'attr' => [
                    'placeholder' => 'Nom du media',
                ]
            ])
            ->add('isVideo', CheckboxType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => "Cocher si c'est une vidéo",
                ]
            ])

            ->add('storage', FileType::class, [
                'label' => 'media',
                'mapped' => false,
                'multiple' => false,
                ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Media::class,
        ]);
    }
}
