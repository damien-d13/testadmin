<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\Tag;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        return $this->redirect($routeBuilder->setController(PostCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Testadmin');
    }

    public function configureMenuItems(): iterable
    {
        return [

         MenuItem::linktoDashboard('Tableau de bord', 'fa fa-home'),
         MenuItem::subMenu('Blog')->setSubItems([
         MenuItem::linkToCrud('Categorie', 'fas fa-folder-open', Category::class),
         MenuItem::linkToCrud('Post', 'fas fa-envelope-open', Post::class)->setDefaultSort(['created_at' => 'DESC']),
         MenuItem::linkToCrud('Tag', 'fas fa-tag', Tag::class),
        ]),
        ];
    }
}
