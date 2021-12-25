<?php

namespace App\Controller\Admin;

use App\Entity\HomeEditor;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HomeEditorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HomeEditor::class;
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
