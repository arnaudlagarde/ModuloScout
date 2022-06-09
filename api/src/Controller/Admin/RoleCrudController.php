<?php

namespace App\Controller\Admin;

use App\Entity\Role;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
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
            ->setEntityLabelInPlural('des rôles')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom'),
            TextareaField::new('description', 'Description'),
            AssociationField::new('categories', 'Catégories'),
            AssociationField::new('participants', 'Participants invités'),
            DateTimeField::new('startDate', 'Date de début')->renderAsChoice(),
            DateTimeField::new('endDate', 'Date de fin')->renderAsChoice(),
            AssociationField::new('scope', 'Scope'),
            BooleanField::new('active', 'Actif'),
            DateTimeField::new('createdAt', 'Créé le')
                ->hideOnForm()
        ];
    }
}
