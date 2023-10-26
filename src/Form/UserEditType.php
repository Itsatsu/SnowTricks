<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints AS Assert;


class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //ajouter les required
            ->add('username', TextType::class, [
                'required' => true,
                'attr'=> [
                    'placeholder' => 'Username',
                ],
                ])
            ->add('email', EmailType::class, [
                'required' => true,
                'attr'=> [
                'placeholder' => 'mail@email.fr',
                ],
                ])
            ->add('firstName', TextType::class, [
                'required' => true,
                'attr'=> [
                'placeholder' => 'John',
                ],
                ])
            ->add('lastName', TextType::class, [
                'required' => true,
                'attr'=> [
                'placeholder' => 'Doe',
                ],
                ])
            ->add('photoPath', FileType::class, [
                'label' => 'Image du profile',
                'mapped' => false,
                'multiple' => false,
                'required' => false,
                'attr' => ['accept' => '.jpg,.jpeg', 'maxSize' => '5M','id' => 'inputImage', 'onchange' => "afficherApercuImage()"],
                'constraints' => [
                    new Assert\File([
                        'maxSize' => '5M',
                        'maxSizeMessage' => 'Le fichier ne doit pas dépasser 5 Mo.',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/jpg'
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger un fichier JPG ou JPEG valide.',
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
