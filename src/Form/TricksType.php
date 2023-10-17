<?php

namespace App\Form;

use App\Entity\Group;
use App\Entity\Media;
use App\Entity\Tricks;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class TricksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [

                    'required' => true,
                'attr' => [
                    'placeholder' => 'Nom du tricks',
                ]
            ])
            ->add('description', TextareaType::class,[
                'required' => true,
                'attr' => [
                    'placeholder' => 'Description du tricks',
                    'rows' => '15',
                ]


            ])
            ->add('pictureStorage', FileType::class, [
                'label' => 'Image principale',
                'mapped' => false,
                'multiple' => false,
                'required' => false,
                'attr' => ['accept' => '.jpg,.jpeg', 'maxSize' => '5M'],
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
            ->add('categorie', EntityType::class, [
                'class' => Group::class,
                'choice_label' => 'name',
                'multiple' => false,
                'required' => true,
            ])
            ->add('media', CollectionType::class, [
                'entry_type' => MediaType::class,
                'label' => 'Les médias secondaire du tricks',
                'entry_options' => ['label' => false, 'required' => false],

                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tricks::class,
        ]);
    }
}
