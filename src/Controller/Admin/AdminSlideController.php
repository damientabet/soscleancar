<?php

namespace App\Controller\Admin;

use App\Entity\Slide;
use App\Form\SlideType;
use App\Repository\SlideRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminSlideController
 * @package App\Controller\Admin
 * @Route("/admin/slide")
 */
class AdminSlideController extends AbstractController
{
    private $fileUploader;

    public function __construct(FileUploader $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }
    /**
     * @Route("/", name="admin.slide.list")
     * @param SlideRepository $slideRepository
     * @return Response
     */
    public function list(SlideRepository $slideRepository)
    {
        return $this->render('admin/slide/list.html.twig', [
            'slides' => $slideRepository->findAll()
        ]);
    }

    /**
     * @Route("/create", name="admin.slide.create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $slide = new Slide();
        $form = $this->createForm(SlideType::class, $slide);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form['img_name']->getData();
            $this->addImage($slide, $imageFile);

            $em = $this->getDoctrine()->getManager();
            $em->persist($slide);
            $em->flush();

            $this->addFlash('success', 'Le slide a été bien été créé.');
            return $this->redirectToRoute('admin.slide.list');
        }

        return $this->render('admin/slide/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit/", name="admin.slide.edit")
     * @param Slide $slide
     * @param Request $request
     * @return Response
     */
    public function edit(Slide $slide, Request $request)
    {
        $form = $this->createForm(SlideType::class, $slide);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($slide);
            $em->flush();

            $this->addFlash('success', 'Le slide a été bien été mis à jour.');
            return $this->redirectToRoute('admin.slide.list');
        }

        return $this->render('admin/slide/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/delete", name="admin.slide.delete")
     * @param Slide $slide
     * @return RedirectResponse
     */
    public function delete(Slide $slide)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($slide);
        $em->flush();

        $this->addFlash('success', 'Le slide a bien été supprimée.');

        return $this->redirectToRoute('admin.slide.list');
    }

    public function addImage(Slide $slide, $imageFile)
    {
        if ($imageFile) {
            $imageFileName = $this->fileUploader->upload($imageFile);
            $slide->setImgName($imageFileName);
        }
    }
}