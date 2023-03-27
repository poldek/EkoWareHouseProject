<?php

namespace App\Controller\Admin;

use App\Entity\Products;
use App\Entity\ProductUnit;
use App\Entity\User;
use App\Entity\Warehouses;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('EkoWareHouse');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard admin', 'fa fa-home');
        yield MenuItem::linkToRoute('Dashboard user', 'fa fa-home','app_home');
        yield MenuItem::linkToCrud('User', 'fas fa-list', User::class)
            ->setPermission('ROLE_ADMIN');

        yield MenuItem::subMenu('Warehouse/Product', 'fa fa-list')->setSubItems([
            MenuItem::linkToCrud('Warehouse ', 'fa fa-bars', Warehouses::class),
            MenuItem::linkToCrud('Product', 'fa fa-bars', Products::class),
            MenuItem::linkToCrud('Unit', 'fa fa-bars', ProductUnit::class)
        ])->setPermission('ROLE_ADMIN');
    }
}
