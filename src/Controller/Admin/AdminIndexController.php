<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminIndexController
 * @package App\Controller\Admin
 * @Route("/{_locale}/admin", requirements={"_locale": "en|fr",})
 */
class AdminIndexController extends AbstractController
{
    /**
     * @Route("/", name="admin.index")
     * @return Response
     */
    public function index()
    {
        return $this->render('admin/dashboard.html.twig');
    }
}