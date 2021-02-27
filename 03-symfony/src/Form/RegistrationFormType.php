<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Nombre de usuario',
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
            ->add('email', EmailType::class, [
                'label' => 'Correo electrónico',
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
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Debe aceptar los términos y condiciones.',
                    ]),
                ],
                'label' => 'Acepto los <a class="text-blue-600" href="/terminos-y-condiciones" target="_blank">términos y condiciones</a>',
                'label_html' => true,
                'row_attr' => [
                    'class' => 'text-center mb-3'
                ],
                'label_attr' => [
                    'class' => 'font-semibold text-lg mx-4'
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor ingrese una contraseña',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Su contraseña debe ser de al menos {{ limit }} caracteres',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
