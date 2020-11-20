<?php

namespace App\Controller\Front;

use App\Repository\SlideRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param SlideRepository $slideRepository
     * @return Response
     */
    public function index(SlideRepository $slideRepository)
    {
        return $this->render('index.html.twig', [
            'slides' => $slideRepository->findAll()
        ]);
    }
}