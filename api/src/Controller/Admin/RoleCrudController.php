<?php

namespace App\Controller\Admin;

use App\Entity\Role;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RoleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Role::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Rôles')
            ->setPageTitle('new', 'Créer un rôle')
            ->setPageTitle('edit', 'Modifier un rôle')
            ->setPageTitle('detail', "Détails d'un rôle")
            ->setEntityLabelInSingular('un rôle')
            ->setEntityLabelInPlural('des rôles');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            yield TextField::new('name', 'Nom'),
            yield TextField::new('code', 'Code')
        ];
    }
}
