<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\HomeEditor;
use App\Entity\HomeReinsurance;
use App\Entity\Slide;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Mywebsite');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linktoDashboard('Dashboard', 'fa fa-home'),
            MenuItem::section('Blog'),
            MenuItem::subMenu('Articles', 'fa fa-newspaper')->setSubItems([
                MenuItem::linkToCrud('Article', 'fas fa-newspaper', Article::class),
                MenuItem::linkToCrud('Categories', 'fa fa-tags', Category::class),
            ]),
            MenuItem::section('Apparence'),
            MenuItem::linkToCrud('Slide', 'fas fa-list', Slide::class),
            MenuItem::linkToCrud('Home', 'fas fa-list', HomeEditor::class),
            MenuItem::linkToCrud('Reinsurance', 'fas fa-list', HomeReinsurance::class),
            MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class),
        ];
    }
}
