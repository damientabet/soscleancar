<?php

namespace App\Controller\Front;

use App\Form\ContactType;
use App\Repository\CategoryRepository;
use Swift_Mailer;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ContactController
 * @package App\Controller\Front
 * @Route("/contact")
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/", name="contact")
     * @param Request $request
     * @param Swift_Mailer $mailer
     * @return Response
     */
    public function index(Request $request, Swift_Mailer $mailer,  CategoryRepository $categoryRepository): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();

            $message = (new Swift_Message('Hello Email'))
                ->setFrom('test.damien.tabet@gmail.com')
                ->setTo('tabetdamien@free.fr')
                ->setBody('Sending emails is fun again!');

            $mailer->send($message);

            $this->addFlash('success', 'Your message has been sent');

            return $this->redirectToRoute('contact');
        }
        return $this->render('@front/contact.html.twig', [
            'form' => $form->createView(),
            'categories' => $categoryRepository->findAll(),
        ]);
    }
}