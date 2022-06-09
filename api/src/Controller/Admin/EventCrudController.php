<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Event::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Évènements')
            ->setPageTitle('new', 'Créer un évènement')
            ->setPageTitle('edit', 'Modifier un évènement')
            ->setPageTitle('detail', "Détails d'un évènement")
            ->setEntityLabelInSingular('un évènement')
            ->setEntityLabelInPlural('des évènements')
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
            BooleanField::new('active', 'Actif')
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ;
    }
}
