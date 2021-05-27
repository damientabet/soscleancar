<?php

namespace App\Controller\Front;

use App\Entity\Article;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class ArticleController
 * @package App\Controller\Front
 * @Route("/article")
 */
class ArticleController extends AbstractController
{
    protected $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @Route("/{id}-{slug}", name="article.index", requirements={"id": "[0-9]*"})
     * @param Article $article
     * @param $slug
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    public function index(Article $article, $slug, CategoryRepository $categoryRepository)
    {
        $this->checkSlug($article, $slug);
        return $this->render('@front/article.html.twig',  [
            'article' => $article,
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    public function checkSlug($article, $slug)
    {
        if ($article->getSlug() !== $slug) {
            $response = new RedirectResponse($this->router->generate('article.index', [
                'id' => $article->getId(),
                'slug' => $article->getSlug()]));
            return $response->send();
        }
    }
}