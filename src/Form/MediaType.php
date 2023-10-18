<?php

namespace App\Form;

use App\Entity\Media;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $css_attributes = [
            'attr' => ['class' => 'p-5'],
            'label_attr' => ['class' => 'block text-sm font-medium leading-6 text-gray-900'],
            'row_attr' => ['class' => 'p-2']
        ];

        $builder
            ->add('name',TextType::class,array_replace_recursive($css_attributes,[
                'label' => 'Nom du media',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un nom pour le media',
                    ]),
                ],
                'attr' => [

                    'placeholder' => 'Nom du media',
                    'class' => 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-accent placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary2 sm:text-sm sm:leading-6',

                ]

            ]))
            ->add('isVideo', CheckboxType::class,array_replace_recursive($css_attributes, [
                'label' => "Cocher si c'est une vidéo",
                'row_attr' => ['class' => 'flex flex-row items-center justify-center space-x-2 p-2'],
                'attr' => [
                    'class' => " py-1.5  -ml-[1.5rem] mr-[6px] mt-[0.15rem] h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem] border-[0.125rem] border-solid border-neutral-300 outline-none before:pointer-events-none before:absolute before:h-[0.875rem] before:w-[0.875rem] before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-[0px_0px_0px_13px_transparent] before:content-[''] checked:border-primary checked:bg-primary2 checked:before:opacity-[0.16] checked:after:absolute checked:after:-mt-px checked:after:ml-[0.25rem] checked:after:block checked:after:h-[0.8125rem] checked:after:w-[0.375rem] checked:after:rotate-45 checked:after:border-[0.125rem] checked:after:border-l-0 checked:after:border-t-0 checked:after:border-solid checked:after:border-white checked:after:bg-transparent checked:after:content-[''] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[0px_0px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-[0.875rem] focus:after:w-[0.875rem] focus:after:rounded-[0.125rem] focus:after:content-[''] checked:focus:before:scale-100 checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:after:-mt-px checked:focus:after:ml-[0.25rem] checked:focus:after:h-[0.8125rem] checked:focus:after:w-[0.375rem] checked:focus:after:rotate-45 checked:focus:after:rounded-none checked:focus:after:border-[0.125rem] checked:focus:after:border-l-0 checked:focus:after:border-t-0 checked:focus:after:border-solid checked:focus:after:border-white checked:focus:after:bg-transparent dark:border-neutral-600 dark:checked:border-primary dark:checked:bg-primary dark:focus:before:shadow-[0px_0px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[0px_0px_0px_13px_#3b71ca]"

                ]
            ]))
            ->add('picture',FileType::class,array_replace_recursive($css_attributes,[
                'label' => 'Image',
                'required' => false,
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
                ],
                'attr' => [
                    'accept' => '.jpg,.jpeg', 'maxSize' => '5M',
                    'class' => 'p-2 relative m-0 block w-full min-w-0 flex-auto rounded-md border border-solid border-accent bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-accent file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:ring-primary2 focus:text-neutral-700',
                ]
                ]))
            ->add('video', TextType::class, array_replace_recursive($css_attributes,[
                'label' => 'Lien de la vidéo',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Balise iframe de la vidéo',
                    'class' => 'p-2 w-full rounded-md border-0  px-3 py-[0.32rem]  outline-none',
                    ]]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Media::class,
        ]);
    }
}
