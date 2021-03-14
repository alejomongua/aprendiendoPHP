<?php

namespace App\Form;

use App\Entity\Etiqueta;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtiquetaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, [
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
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'my-4 p-4 border rounded shadow bg-blue-300',
                    'type' => 'submit',
                ],
                'label' => 'Guardar',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etiqueta::class,
        ]);
    }
}
