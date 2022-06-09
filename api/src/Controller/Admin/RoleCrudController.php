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
            yield TextField::new('name', 'Nom'),
            yield TextareaField::new('description', 'Description'),
            yield AssociationField::new('categories', 'Catégories'),
            yield AssociationField::new('participants', 'Participants invités'),
            yield DateTimeField::new('startDate', 'Date de début')->renderAsChoice(),
            yield DateTimeField::new('endDate', 'Date de fin')->renderAsChoice(),
            yield AssociationField::new('scope', 'Scope'),
            yield BooleanField::new('active', 'Actif'),
            yield DateTimeField::new('createdAt', 'Créé le')
                ->hideOnForm()
        ];
    }
}
