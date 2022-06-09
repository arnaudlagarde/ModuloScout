<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Catégories')
            ->setPageTitle('new', 'Créer une catégorie')
            ->setPageTitle('edit', 'Modifier une catégorie')
            ->setPageTitle('detail', "Détails d'une catégorie")
            ->setEntityLabelInSingular('une catégorie')
            ->setEntityLabelInPlural('des catégories')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            yield TextField::new('name', 'Nom'),
            yield TextField::new('description', 'Description'),
            yield AssociationField::new('invitedRoles', 'Rôles invités par défaut'),
            yield DateTimeField::new('createdAt', 'Créé le')
                ->hideOnForm()
        ];
    }
}
