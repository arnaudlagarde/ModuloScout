<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Event;
use App\Entity\Role;
use App\Entity\Scope;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('App');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Back to the website', 'fa fa-home');
        yield MenuItem::linkToCrud('Scopes', 'fas fa-users-cog', Scope::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-list-ul', Category::class);
        yield MenuItem::linkToCrud('Roles', 'fas fa-user-tag', Role::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Events', 'fas fa-calendar-alt', Event::class);
    }
}
