<?php

namespace App\Controller\Admin;

use App\Entity\HomeEditor;
use App\Form\HomeEditorType;
use App\Form\HomeReinsuranceType;
use App\Repository\HomeEditorRepository;
use App\Repository\HomeReinsuranceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminHomeEditorController
 * @package App\Controller\Admin
 * @Route("/{_locale}/admin/home", requirements={"_locale": "en|fr",})
 */
class AdminHomeEditorController extends AbstractController
{
    /**
     * @Route("/editor", name="admin.home.editor")
     */
    public function index(HomeReinsuranceRepository $reinsuranceRepository): Response
    {
        return $this->render('admin/home/index.html.twig', [
            'controller_name' => 'AdminHomeEditorController',
            'reinsurances' => $reinsuranceRepository->findAll()
        ]);
    }

    /**
     * @Route("/blocks", name="admin.home.editor.blocks.list")
     * @return Response
     */
    public function listBlock(HomeEditorRepository $homeEditorRepository): Response
    {
        return $this->render('admin/home/listBlocks.html.twig', [
            'controller_name' => 'AdminHomeEditorController',
            'homeBlocks' => $homeEditorRepository->findAll()
        ]);
    }

    /**
     * @Route("/blocks/{id}/edit", name="admin.home.editor.blocks.edit")
     * @return Response
     */
    public function editBlock(HomeEditor $homeEditor, Request $request)
    {
        $form = $this->createForm(HomeEditorType::class, $homeEditor);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($homeEditor);
            $em->flush();

            $this->addFlash('success', 'L\'élément de la page d\'accueil a été mis à jour.');
            return $this->redirectToRoute('admin.home.editor.blocks.list');
        }
        return $this->render('admin/home/editBlock.html.twig', [
            'controller_name' => 'AdminHomeEditorController',
            'form' => $form->createView()
        ]);
    }
}
