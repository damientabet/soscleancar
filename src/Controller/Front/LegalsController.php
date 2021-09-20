<?php

namespace App\Controller\Front;

use App\Entity\Article;
use App\Entity\Legals;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Cache\CacheInterface;

/**
 * Class ArticleController
 * @package App\Controller\Front
 * @Route("/legals")
 */
class LegalsController extends AbstractController
{
    protected $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @Route("/{id}", name="legals.index", requirements={"id": "[0-9]*"})
     * @param Legals $legals
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    public function index(Legals $legals, CategoryRepository $categoryRepository, CacheInterface $cache): Response
    {
        $datas = $cache->get('legals.datas', function () use ($categoryRepository, $legals) {
            return [
                'legal' => $legals,
                'categories' => $categoryRepository->findAll()
            ];
        });
        return $this->render('@front/legals.html.twig',  $datas);
    }
}