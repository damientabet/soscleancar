<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class AdminArticleController
 * @package App\Controller\Admin
 * @Route("{_locale}/admin/article", requirements={"_locale": "en|fr"})
 */
class AdminArticleController extends AbstractController
{
    private $translator;
    private $fileUploader;
    private $targetDirectory;

    public function __construct(TranslatorInterface $translator, FileUploader $fileUploader, $targetDirectory)
    {
        $this->translator = $translator;
        $this->fileUploader = $fileUploader;
        $this->targetDirectory = $targetDirectory;
    }
    /**
     * @Route("/list", name="admin.article.list")
     * @param ArticleRepository $articleRepository
     * @return Response
     */
    public function list(ArticleRepository $articleRepository): Response
    {
        return $this->render('@admin/article/list.html.twig', [
            'articles' => $articleRepository->findAll()
        ]);
    }

    /**
     * @Route("/create", name="admin.article.create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($request->query->get('ajax') == true) {
            return $this->addImage();
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $article->setUpdatedAt(new \DateTime());

            $em->persist($article);
            $em->flush();

            $this->addFlash('success', $this->translator->trans('The article has been created'));
            return $this->redirectToRoute('admin.article.list');
        }

        return $this->render('@admin/article/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit/", name="admin.article.edit")
     * @param Article $article
     * @param Request $request
     * @return Response
     */
    public function edit(Article $article, Request $request): Response
    {
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($request->query->get('ajax') == true) {
            return $this->addImage();
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $article->setUpdatedAt(new \DateTime());

            $em->persist($article);
            $em->flush();

            $this->addFlash('success', $this->translator->trans('The article has been updated'));
        }

        return $this->render('@admin/article/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/delete", name="admin.article.delete")
     * @param Article $article
     * @return RedirectResponse
     */
    public function delete(Article $article): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();

        $this->addFlash('success', $this->translator->trans('The article has been deleted'));

        return $this->redirectToRoute('admin.article.list');
    }

    public function addImage()
    {
        reset ($_FILES);
        $current_file = $_FILES['file'];
        $file = new UploadedFile($current_file['tmp_name'], $current_file['name'], $current_file['type'], $current_file['error']);
        $baseurl = "../../../../../img/admin/articles/";

        $filename = $this->fileUploader->upload($file, $this->getTargetDirectory());

        return new Response(json_encode(array('location' => $baseurl . $filename)));
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}