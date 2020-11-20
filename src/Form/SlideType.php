<?php

namespace App\Form;

use App\Entity\Slide;
use Symfony\Component\Form\AbstractType;
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
            ->add('name')
            ->add('img_name', FileType::class, [
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
            ->add('save', SubmitType::class, ['label' => 'Create Slide'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Slide::class,
        ]);
    }
}
