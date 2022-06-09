<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Utilisateurs')
            ->setPageTitle('new', 'Créer un utilisateur')
            ->setPageTitle('edit', 'Modifier un utilisateur')
            ->setPageTitle('detail', "Détails d'un utilisateur")
            ->setEntityLabelInSingular('un utilisateur')
            ->setEntityLabelInPlural('des utilisateurs')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            yield TextField::new('uuid'),
            yield EmailField::new('email'),
            yield TextField::new('password')->hideOnIndex()->hideOnDetail(),
            yield TextField::new('firstName', 'Prénom'),
            yield TextField::new('lastName', 'Nom'),
            yield TextField::new('genre')
        ];
    }
}
