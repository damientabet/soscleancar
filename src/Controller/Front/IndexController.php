<?php

namespace App\Controller\Front;

use App\Repository\CategoryRepository;
use App\Repository\HomeEditorRepository;
use App\Repository\HomeReinsuranceRepository;
use App\Repository\SlideRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class IndexController extends AbstractController
{
    private $slideRepository;
    private $categoryRepository;
    private $reinsuranceRepository;
    private $homeEditorRepository;

    public function __construct(SlideRepository $slideRepository, CategoryRepository $categoryRepository, HomeReinsuranceRepository $reinsuranceRepository, HomeEditorRepository $homeEditorRepository)
    {
        $this->slideRepository = $slideRepository;
        $this->categoryRepository = $categoryRepository;
        $this->reinsuranceRepository = $reinsuranceRepository;
        $this->homeEditorRepository = $homeEditorRepository;
    }

    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('@front/index.html.twig', [
                'categories' => $this->categoryRepository->findAll(),
                'slides' => $this->slideRepository->findAll(),
                'reinsurances' => $this->reinsuranceRepository->findAll(),
                'homeBlocks' => $this->homeEditorRepository->findAll()
            ]);
    }
}