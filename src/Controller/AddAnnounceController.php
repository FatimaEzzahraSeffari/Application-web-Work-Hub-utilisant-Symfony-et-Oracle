<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Repository\AnnonceRepository;
use App\Form\AnnonceFormType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddAnnounceController extends AbstractController
{
#[Route('/Addannounce', name: 'app_addannounce')]
    public function AddNewProduit(Request $request, EntityManagerInterface $entityManager, AnnonceRepository $postRepository): Response
    {
    $post = new Annonce();
    $form = $this->createForm(AnnonceFormType::class, $post);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
    $post=$form->getData();
    $entityManager->persist($post);
    $entityManager->flush();
    $this->addFlash('success', 'l annonce été ajouté avec succès');
    $posts = $postRepository->findAll();
    //  return $this->render('add_movie/index.html.twig',
    //  ['posts' => $posts]);
    return $this->redirectToRoute('app_home', ['id' => $post->getId()]);
    }
    return $this->render('AddAnnonce/index.html.twig', [
    'form' => $form->createView(),
    ]);
    }

    #[Route('/show', name: 'app_show')]
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
}