<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminArticleController
 * @package App\Controller\Admin
 * @Route("/admin/article")
 */
class AdminArticleController extends AbstractController
{
    /**
     * @Route("/list", name="admin.article.list")
     * @param ArticleRepository $articleRepository
     * @return Response
     */
    public function list(ArticleRepository $articleRepository)
    {
        return $this->render('admin/article/list.html.twig', [
            'articles' => $articleRepository->findAll()
        ]);
    }

    /**
     * @Route("/create", name="admin.article.create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $article->setUpdatedAt(new \DateTime());

            $em->persist($article);
            $em->flush();

            $this->addFlash('success', 'L\'article a été bien été créé.');
            return $this->redirectToRoute('admin.article.list');
        }

        return $this->render('admin/article/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit/", name="admin.article.edit")
     * @param Article $article
     * @param Request $request
     * @return Response
     */
    public function edit(Article $article, Request $request)
    {
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $article->setUpdatedAt(new \DateTime());

            $em->persist($article);
            $em->flush();

            $this->addFlash('success', 'L\'article a été bien été mis à jour.');
        }

        return $this->render('admin/article/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/delete", name="admin.article.delete")
     * @param Article $article
     * @return RedirectResponse
     */
    public function deleteTaskAction(Article $article)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();

        $this->addFlash('success', 'La tâche a bien été supprimée.');

        return $this->redirectToRoute('admin.article.list');
    }
}