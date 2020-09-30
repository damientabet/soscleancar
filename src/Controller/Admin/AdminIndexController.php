<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminIndexController extends AbstractController
{
    /**
     * @Route("/admin/", name="admin.index")
     * @return Response
     */
    public function index()
    {
        return $this->render('admin/dashboard.html.twig');
    }
}