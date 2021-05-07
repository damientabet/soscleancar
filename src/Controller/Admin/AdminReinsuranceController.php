<?php

namespace App\Controller\Admin;

use App\Entity\HomeReinsurance;
use App\Form\HomeReinsuranceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminReinsuranceController extends AbstractController
{
    /**
     * @Route("{_locale}/admin/reinsurance/{id}/edit", name="admin.reinsurance.edit", requirements={"_locale": "en|fr"})
     */
    public function edit(HomeReinsurance $reinsurance, Request $request)
    {
        $form = $this->createForm(HomeReinsuranceType::class, $reinsurance);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($reinsurance);
            $em->flush();

            $this->addFlash('success', 'La réassurance a été mis à jour.');
            return $this->redirectToRoute('admin.home.editor');
        }

        return $this->render('admin/home/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
