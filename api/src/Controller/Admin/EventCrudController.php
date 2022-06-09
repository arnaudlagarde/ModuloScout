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
            yield TextField::new('name', 'Nom'),
            yield TextareaField::new('description', 'Description'),
            yield AssociationField::new('categories', 'Catégories'),
            yield AssociationField::new('participants', 'Participants invités'),
            yield DateTimeField::new('startDate', 'Date de début')->renderAsChoice(),
            yield DateTimeField::new('endDate', 'Date de fin')->renderAsChoice(),
            yield AssociationField::new('scope', 'Scope'),
            yield BooleanField::new('active', 'Actif')
        ];
    }
}
