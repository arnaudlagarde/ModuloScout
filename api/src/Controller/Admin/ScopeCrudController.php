<?php

namespace App\Controller\Admin;

use App\Entity\Scope;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class ScopeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Scope::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Scopes')
            ->setPageTitle('new', 'Créer un scope')
            ->setPageTitle('edit', 'Modifier un scope')
            ->setPageTitle('detail', "Détails d'une scope")
            ->setEntityLabelInSingular('une scope')
            ->setEntityLabelInPlural('des scopes')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('user', 'Utilisateur'),
            AssociationField::new('structure', 'Structure'),
            AssociationField::new('role', 'Rôle'),
            DateTimeField::new('createdAt', 'Créé le')
                ->hideOnForm(),
            BooleanField::new('active', 'Actif'),
        ];
    }

}
