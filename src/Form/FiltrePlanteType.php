<?php

namespace App\Form;

use App\Entity\Plante;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class FiltrePlanteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
    
        ->add('exposition', ChoiceType::class, [
            'choices' => [
                'Soleil' => 'Soleil',
                'Mi-ombre' => 'Mi-ombre',
                'Ombre' => 'Ombre',
            ],
            'multiple' => true, // Autorise la sélection de plusieurs options
            'expanded' => true, // Affiche les options sous forme de cases à cocher
           

        ])
        ->add('besoinEau', ChoiceType::class, [
            'choices' => [
                'Faible' => 'Faible',
                'Moyen' => 'Moyen',
                'Important' => 'Important',
            ],
            'multiple' => true, // Autorise la sélection de plusieurs options
            'expanded' => true, // Affiche les options sous forme de cases à cocher
           

        ])

        ->add('lieuCultive', ChoiceType::class, [
            'choices' => [
                'Intérieur' => 'Intérieur',
                'Balcon ou terrasse' => 'Balcon ou terrasse',
                'Jardin' => 'Jardin',
                'Potager ou verger' => 'Potager ou verger',
            ],
            'multiple' => true, // Autorise la sélection de plusieurs options
            'expanded' => true, // Affiche les options sous forme de cases à cocher
           

        ])
        ;


            // ->add('exposition', ChoiceType::class, [
            //     'choices' => [
            //         'Soleil' => 'Soleil',
            //         'Mi-ombre' => 'Mi-ombre',
            //         'Ombre' => 'Ombre',
            //     ],
            //     'multiple' => true, // Autorise la sélection de plusieurs options
            //     'expanded' => true, // Affiche les options sous forme de cases à cocher
            //     'attr' => [
            //         'class' => 'form-check-input',
            //         'type' => 'checkbox',
            //         'value' => '',
            //         'id' => "flexCheckDefault"
            //     ],


            // ]);





    


        // ])
        // ->add('exposition', CheckboxType::class, [
        //     'label' => 'Mi-Ombre ',
        //     'required' => false,
        //     'attr' => [
        //         'class' => 'form-check-input',
        //         'type' => 'checkbox',
        //         'value'=>'',
        //         'id'=>"flexCheckDefault"],

        //     'label_attr' => [
        //             'class' => 'form-check-label',
        //             'for' => 'flexCheckDefault',
        //     ],

        // ])
        // ->add('exposition', CheckboxType::class, [
        //     'label' => 'Ombre ',
        //     'required' => false,
        //     'attr' => [
        //         'class' => 'form-check-input',
        //         'type' => 'checkbox',
        //         'value'=>'',
        //         'id'=>"flexCheckDefault"],

        //     'label_attr' => [
        //             'class' => 'form-check-label',
        //             'for' => 'flexCheckDefault',
        //     ],

        // ])


        // ->add('besoinEau', CheckboxType::class, [
        //     'label' => 'Faible ',
        //     'required' => false,
        //     'attr' => [
        //         'class' => 'form-check-input',
        //         'type' => 'checkbox',
        //         'value'=>'',
        //         'id'=>"flexCheckDefault"],

        //     'label_attr' => [
        //             'class' => 'form-check-label',
        //             'for' => 'flexCheckDefault',
        //     ],

        // ])
        // ->add('besoinEau', CheckboxType::class, [
        //     'label' => 'Moyen ',
        //     'required' => false,
        //     'attr' => [
        //         'class' => 'form-check-input',
        //         'type' => 'checkbox',
        //         'value'=>'',
        //         'id'=>"flexCheckDefault"],

        //     'label_attr' => [
        //             'class' => 'form-check-label',
        //             'for' => 'flexCheckDefault',
        //     ],

        // ])

        // ->add('besoinEau', CheckboxType::class, [
        //     'label' => 'Difficile ',
        //     'required' => false,
        //     'attr' => [
        //         'class' => 'form-check-input',
        //         'type' => 'checkbox',
        //         'value'=>'',
        //         'id'=>"flexCheckDefault"],

        //     'label_attr' => [
        //             'class' => 'form-check-label',
        //             'for' => 'flexCheckDefault',
        //     ],

        // ]);






    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // 'data_class' => Plante::class,
        ]);
    }
}
