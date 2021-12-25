<?php

namespace App\Controller\Admin;

use App\Entity\HomeReinsurance;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HomeReinsuranceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HomeReinsurance::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
