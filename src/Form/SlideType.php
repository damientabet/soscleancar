<?php

namespace App\Form;

use App\Entity\Slide;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SlideType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Name'])
            ->add('title', TextType::class, ['label' => 'Title'])
            ->add('description', TextType::class, ['label' => 'Description'])
            ->add('img_name', FileType::class, [
                'label' => 'Image name',
                'mapped' => false,
                'required' => false,
            ])
            ->add('link', TextType::class, [
                'required' => false,
                'empty_data' => '',
            ])
            ->add('video_link', TextType::class, [
                'required' => false,
                'empty_data' => '',
            ])
            ->add('container_alignment', ChoiceType::class, [
                'label' => 'Container alignment',
                'choices' => [
                    'Top Left' => 'tl',
                    'Top Center' => 'tc',
                    'Top Right' => 'tr',
                    'Middle Left' => 'ml',
                    'Middle Center' => 'mc',
                    'Middle Right' => 'mr',
                    'Bottom Left' => 'bl',
                    'Bottom Center' => 'bc',
                    'Bottom Right' => 'br',
                ]
            ])
            ->add('text_alignment', ChoiceType::class, [
                'label' => 'Text alignment',
                'choices' => [
                    'Left' => 'text-left',
                    'Right' => 'text-right',
                    'Center' => 'text-center',
                ]
            ])
            ->add('container_apparaition', ChoiceType::class, [
                'label' => 'Container apparaition',
                'choices' => [
                    'Fade' => 'fade',
                    'Left' => 'left',
                    'Right' => 'right',
                    'Top' => 'top',
                    'Bottom' => 'bottom',
                ]
            ])
            ->add('buttonTitle', TextType::class, ['label' => 'Button title'])
            ->add('buttonLink', TextType::class, ['label' => 'Button link'])
            ->add('submit', SubmitType::class, ['label' => 'Save'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Slide::class,
        ]);
    }
}
