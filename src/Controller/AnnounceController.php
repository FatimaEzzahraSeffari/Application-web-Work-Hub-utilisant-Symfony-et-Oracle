<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Repository\AnnonceRepository;
use App\Form\AnnonceFormType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AnnonceEditFormType ;
class AnnounceController extends AbstractController
{
    #[Route('/announce', name: 'app_announce')]
    public function index2(EntityManagerInterface $entityManager, AnnonceRepository $produitRepository, CategoryRepository $categoryRepository, Request $request): Response {
        $categoryName = $request->query->get('category');
        if (!$categoryName) {
            $produit = $produitRepository->findAll();
        } else {
            $category = $categoryRepository->findOneBy(['name' => $categoryName]);
            $produit = $produitRepository->findBy(['Category' => $category]);
        }
        $categories = $categoryRepository->findAll();
        return $this->render('announce/index.html.twig', [
            'posts' => $produit,
            'categories' => $categories,
            'currentCategory' => $categoryName
        ]);
    }
    
    #[Route('/showannounce', name: 'app_showannounce')]
    public function showProducts(ManagerRegistry $doctrine)
    {
        $products = $doctrine->getManager()->getRepository(Annonce::class)->findAll();
    
        return $this->render('showannounce.html.twig', [
            'posts' => $products,
        ]);
    }
    #[Route('/editAnnounce/{id}', name: 'app_annonce_edit')]
    public function editUser(Annonce $user, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AnnonceEditFormType::class, $user);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
    
            return $this->redirectToRoute('app_showannounce', ['id' => $user->getId()]);
        }
    
        return $this->render('announce/edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }
    
    #[Route('/deleteconfirm1/{id}', name: 'app_annonce_delete')]
    public function confirmDelete(Annonce $user, Request $request, ManagerRegistry $doctrine): Response
{
    if ($request->getMethod() == 'POST') {
        $em = $doctrine->getManager();
        $em->remove($user);
        $em->flush();
    
        return $this->redirectToRoute('app_showannounce');
    }
    
    return $this->render('announce/deleteAnnonce.html.twig', [
        'users' => $user,
    ]);
}
     
}