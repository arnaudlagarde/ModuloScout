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
            TextField::new('name', 'event.name'),
            TextareaField::new('description', 'event.description'),
            AssociationField::new('categories', 'event.categories'),
            AssociationField::new('participants', 'event.participants'),
            DateTimeField::new('startDate', 'event.start_date')->renderAsChoice(),
            DateTimeField::new('endDate', 'event.end_date')->renderAsChoice(),
            AssociationField::new('scope', 'event.scope'),
            BooleanField::new('active', 'event.active')
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ;
    }
}
