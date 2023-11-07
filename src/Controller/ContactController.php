<?php

namespace App\Controller;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContactRepository;
use App\Form\ContactFormType;
class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(): Response
    {
        return $this->render('contact.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
    #[Route('/contact', name: 'app_contact')]
    public function AddNewProduit(Request $request, EntityManagerInterface $entityManager, ContactRepository $postRepository): Response
    {
    $post = new Contact();
    $form = $this->createForm(ContactFormType::class, $post);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
    $post=$form->getData();
    $entityManager->persist($post);
    $entityManager->flush();
    $this->addFlash('success', 'le message été envoyé avec succès');
    $posts = $postRepository->findAll();
    
    return $this->redirectToRoute('app_home', ['id' => $post->getId()]);
    }
    return $this->render('contact.html.twig', [
    'form' => $form->createView(),
    ]);
    }

   
}