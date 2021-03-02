<?php

namespace App\Form;

use App\Entity\Proyecto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProyectoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('inicio', HiddenType::class)
            ->add('fin', HiddenType::class)
            ->add('estado', TextType::class, [
                'label_attr' => [
                    'class' => 'block m-4 leading-10'
                ],
                'attr' => [
                    'class' => 'border-2 rounded shadow border-gray-700 p-2'
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
            ])
            ->add('save', ButtonType::class, [
                'attr' => ['class' => 'my-4 p-4 border rounded shadow bg-blue-300'],
                'label' => 'Guardar',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Proyecto::class,
        ]);
    }
}
