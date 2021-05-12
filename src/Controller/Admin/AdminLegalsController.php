<?php

namespace App\Controller\Admin;

use App\Entity\Legals;
use App\Form\LegalsType;
use App\Repository\LegalsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class AdminLegalsController
 * @package App\Controller\Admin
 * @Route("{_locale}/admin/legals", requirements={"_locale": "en|fr",})
 */
class AdminLegalsController extends AbstractController
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
    /**
     * @Route("/", name="admin.legals.list")
     */
    public function list(LegalsRepository $legalsRepository): Response
    {
        return $this->render('admin/legals/list.html.twig', [
            'legals' => $legalsRepository->findAll()
        ]);
    }

    /**
     * @Route("/create", name="admin.legals.create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $legals = new Legals();
        $form = $this->createForm(LegalsType::class, $legals);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $legals->setCreatedAt(new \DateTime());
            $legals->setUpdatedAt(new \DateTime());

            $em->persist($legals);
            $em->flush();

            $this->addFlash('success', $this->translator->trans('The page has been created'));
            return $this->redirectToRoute('admin.legals.list');
        }
        return $this->render('admin/legals/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit/", name="admin.legals.edit")
     * @param Legals $legals
     * @param Request $request
     * @return Response
     */
    public function edit(Legals $legals, Request $request): Response
    {
        $form = $this->createForm(LegalsType::class, $legals);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $legals->setUpdatedAt(new \DateTime());

            $em->persist($legals);
            $em->flush();

            $this->addFlash('success', $this->translator->trans('The page has been updated'));
            return $this->redirectToRoute('admin.legals.list');
        }

        return $this->render('admin/legals/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/delete", name="admin.legals.delete")
     * @param Legals $legals
     * @return RedirectResponse
     */
    public function delete(Legals $legals): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($legals);
        $em->flush();

        $this->addFlash('success', $this->translator->trans('The page has been deleted'));

        return $this->redirectToRoute('admin.legals.list');
    }
}