<?php

namespace App\Form;

use App\Entity\Tarea;
use App\Entity\Proyecto;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TareaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('titulo', TextType::class, [
                'label_attr' => [
                    'class' => 'block m-4 leading-10'
                ],
                'attr' => [
                    'class' => 'border-2 rounded shadow border-gray-700 p-2 w-full'
                ],
                'row_attr' => [
                    'class' => 'mx-4 font-semibold'
                ],
            ])
            ->add('inicio', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'border-2 rounded shadow border-gray-700 p-2 w-full'
                ],
                'label_attr' => [
                    'class' => 'block m-4 leading-10'
                ],
                'row_attr' => [
                    'class' => 'mx-4 font-semibold'
                ]
            ])
            ->add('fin', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'border-2 rounded shadow border-gray-700 p-2 w-full'
                ],
                'label_attr' => [
                    'class' => 'block m-4 leading-10'
                ],
                'row_attr' => [
                    'class' => 'mx-4 font-semibold'
                ]
            ])
            ->add('estado', ChoiceType::class, [
                'choices'  => Tarea::ESTADOS,
                'label_attr' => [
                    'class' => 'block m-4 leading-10'
                ],
                'attr' => [
                    'class' => 'border-2 rounded shadow border-gray-700 p-2 w-full'
                ],
                'row_attr' => [
                    'class' => 'mx-4 font-semibold'
                ],
            ])
            ->add('descripcion', TextareaType::class, [
                'label' => 'Descipción',
                'label_attr' => [
                    'class' => 'block m-4 leading-10'
                ],
                'attr' => [
                    'class' => 'border-2 rounded shadow border-gray-700 p-2 w-full h-48'
                ],
                'row_attr' => [
                    'class' => 'mx-4 font-semibold'
                ],
                'required' => false,
            ])
            ->add('tipo', ChoiceType::class, [
                'choices'  => Tarea::TIPOS,
                'label_attr' => [
                    'class' => 'block m-4 leading-10'
                ],
                'attr' => [
                    'class' => 'border-2 rounded shadow border-gray-700 p-2 w-full'
                ],
                'row_attr' => [
                    'class' => 'mx-4 font-semibold'
                ],
            ])
            ->add('progreso', IntegerType::class, [
                'label_attr' => [
                    'class' => 'block m-4 leading-10'
                ],
                'attr' => [
                    'class' => 'border-2 rounded shadow border-gray-700 p-2 w-full',
                    'max' => 100,
                    'min' => 0,
                ],
                'row_attr' => [
                    'class' => 'mx-4 font-semibold'
                ],
            ])
            ->add('padre', EntityType::class, [
                'class' => Tarea::class,
                'label_attr' => [
                    'class' => 'block m-4 leading-10'
                ],
                'attr' => [
                    'class' => 'border-2 rounded shadow border-gray-700 p-2 w-full placeholder-gray-500 placeholder-opacity-50'
                ],
                'row_attr' => [
                    'class' => 'mx-4 font-semibold'
                ],
                'required' => false,
                'placeholder' => '--',
                'empty_data' => null,
                'choices' => $options['proyecto']->getTareas(),
            ])
            ->add('etiquetas', HiddenType::class, [
                'mapped' => false,
                'attr' => [
                    'class' => 'etiquetas',
                ],
                'data' => $options['etiquetas'],
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'my-4 p-4 border rounded shadow bg-blue-300',
                    'type' => 'submit'
                ],
                'label' => 'Guardar',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tarea::class,
        ]);
        $resolver->setRequired('proyecto');
        $resolver->setAllowedTypes('proyecto', Proyecto::class);
        $resolver->setRequired('etiquetas');
        $resolver->setAllowedTypes('etiquetas', 'string');
    }
}
