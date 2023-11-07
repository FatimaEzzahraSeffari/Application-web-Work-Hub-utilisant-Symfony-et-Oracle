<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Category;

use App\Repository\AnnonceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
   
    #[Route('/about/{id}', name: 'app_aboutt')]
    public function showMovieDetails($id, EntityManagerInterface $entityManager, AnnonceRepository $AnnonceRepository, ManagerRegistry $doctrine): Response
    {
        $Annonce = $AnnonceRepository->find($id);
        $announcements = $doctrine->getRepository(Annonce::class)->findAll();

        if (!$Annonce) {
            throw $this->createNotFoundException('The Annonce does not exist');
        }

        // Fetch the category name associated with the announcement's category ID
        $categoryName = $doctrine->getRepository(Category::class)->find($Annonce->getCategory())->getName();

        return $this->render('AddAnnonce/about.html.twig', [
            'Annonce' => $Annonce,
            'announcements' => $announcements,
            'categoryName' => $categoryName,
        ]);
    }


    
}
