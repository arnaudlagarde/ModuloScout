<?php

namespace App\Controller\Admin;

use App\Entity\Scope;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ScopeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Scope::class;
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
