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
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class AdminSlideController
 * @package App\Controller\Admin
 * @Route("/{_locale}/admin/slide", requirements={"_locale": "en|fr",})
 */
class AdminSlideController extends AbstractController
{
    private $fileUploader;
    private $translator;

    public function __construct(FileUploader $fileUploader, TranslatorInterface $translator)
    {
        $this->fileUploader = $fileUploader;
        $this->translator = $translator;
    }
    /**
     * @Route("/", name="admin.slide.list")
     * @param SlideRepository $slideRepository
     * @return Response
     */
    public function list(SlideRepository $slideRepository): Response
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
    public function create(Request $request): Response
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

            $this->addFlash('success', $this->translator->trans('The slide has been created'));
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
    public function edit(Slide $slide, Request $request): Response
    {
        $form = $this->createForm(SlideType::class, $slide);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($slide);
            $em->flush();

            $this->addFlash('success', $this->translator->trans('The slide has been updated'));
            return $this->redirectToRoute('admin.slide.list');
        }

        return $this->render('admin/slide/edit.html.twig', [
            'form' => $form->createView(),
            'slide' => $slide
        ]);
    }

    /**
     * @Route("/{id}/delete", name="admin.slide.delete")
     * @param Slide $slide
     * @return RedirectResponse
     */
    public function delete(Slide $slide): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($slide);
        $em->flush();

        $this->addFlash('success', $this->translator->trans('The slide has been deleted'));

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