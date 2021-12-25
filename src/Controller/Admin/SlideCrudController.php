<?php

namespace App\Controller\Admin;

use App\Entity\Slide;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class SlideCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Slide::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            ImageField::new('img_name', 'Image')
                ->setUploadDir('public/img/slides')
                ->setBasePath('/img/slides'),
            TextField::new('description'),
            UrlField::new('link')->hideOnIndex(),
            UrlField::new('video_link')->hideOnIndex(),
            ChoiceField::new('container_alignment')->setChoices([
                'Top Left' => 'tl',
                'Top Center' => 'tc',
                'Top Right' => 'tr',
                'Middle Left' => 'ml',
                'Middle Center' => 'mc',
                'Middle Right' => 'mr',
                'Bottom Left' => 'bl',
                'Bottom Center' => 'bc',
                'Bottom Right' => 'br',
            ]),
            ChoiceField::new('text_alignment')->setChoices([
                'Left' => 'text-left',
                'Right' => 'text-right',
                'Center' => 'text-center',
            ])
            ->hideOnIndex(),
            ChoiceField::new('container_apparaition')->setChoices([
                'Fade' => 'fade',
                'Left' => 'left',
                'Right' => 'right',
                'Top' => 'top',
                'Bottom' => 'bottom',
            ])->hideOnIndex(),
            TextField::new('buttonTitle')->hideOnIndex(),
            UrlField::new('buttonLink')->hideOnIndex(),
            BooleanField::new('active')
            ->setFormTypeOptions([
                'data' => true
            ]),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->remove(Crud::PAGE_DETAIL, Action::DELETE)
            ;
    }
}
