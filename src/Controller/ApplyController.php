<?php

namespace App\Controller;

use App\Entity\Apply;
use App\Form\ApplyEditFormType ;
use App\Repository\AnnonceRepository;
use App\Form\AnnonceFormType;
use App\Form\ApplyFormType;
use App\Repository\ApplyRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ApplyController extends AbstractController
{
    #[Route('/Apply/{id}', name: 'app_apply')]
    public function AddNewProduit(Request $request, EntityManagerInterface $entityManager, ApplyRepository $applyRepository, AnnonceRepository $annonceRepository, int $id): Response
    {
        $annonce = $annonceRepository->find($id);
    
        if (!$annonce) {
            throw $this->createNotFoundException('The Annonce does not exist.');
        }
    
        $apply = new Apply();
        $apply->addAnnonce($annonce);
    
        $form = $this->createForm(ApplyFormType::class, $apply);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $resumeCvFile = $form->get('cv')->getData();
            if ($resumeCvFile instanceof UploadedFile) {
                $resumeCvFileName = md5(uniqid()) . '.' . $resumeCvFile->guessExtension();
                $resumeCvFile->move('uploads', $resumeCvFileName);
                $apply->setCv($resumeCvFileName);
            }
    
            $coverLetterFile = $form->get('coverLetter')->getData();
            if ($coverLetterFile instanceof UploadedFile) {
                $coverLetterFileName = md5(uniqid()) . '.' . $coverLetterFile->guessExtension();
                $coverLetterFile->move('uploads', $coverLetterFileName);
                $apply->setCoverLetter($coverLetterFileName);
            }
    
            $entityManager->persist($apply);
            $entityManager->flush();
    
            $this->addFlash('success', 'The application has been added successfully.');
    
            return $this->redirectToRoute('app_home', ['id' => $id]);
        }
    
        return $this->render('Apply.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    

    #[Route('/Applyshow', name: 'app_applyshow')]

    public function applications(ApplyRepository $applyRepository): Response
    {
        $applications = $applyRepository->findAll();

        return $this->render('showApply.html.twig', [
            'applications' => $applications,
        ]);
    }
    #[Route('/editApply/{id}', name: 'app_apply_edit')]
    public function editApply(Apply $apply, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ApplyFormType::class, $apply);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $resumeCvFile = $form->get('cv')->getData();
            if ($resumeCvFile instanceof UploadedFile) {
                $resumeCvFileName = md5(uniqid()) . '.' . $resumeCvFile->guessExtension();
                $resumeCvFile->move('uploads', $resumeCvFileName);
                $apply->setCv($resumeCvFileName);
            }
    
            $coverLetterFile = $form->get('coverLetter')->getData();
            if ($coverLetterFile instanceof UploadedFile) {
                $coverLetterFileName = md5(uniqid()) . '.' . $coverLetterFile->guessExtension();
                $coverLetterFile->move('uploads', $coverLetterFileName);
                $apply->setCoverLetter($coverLetterFileName);
            }
    
            $entityManager->flush();
    
            $this->addFlash('success', 'The application has been updated successfully.');
    
            return $this->redirectToRoute('app_applyshow', ['id' => $apply->getId()]);
        }
    
        return $this->render('editapply.html.twig', [
            'form' => $form->createView(),
            'user' => $apply,
        ]);
    }
    
    
    #[Route('/deleteconfirm2/{id}', name: 'app_apply_delete')]
    public function confirmDelete(Apply $user, Request $request, ManagerRegistry $doctrine): Response
{
    if ($request->getMethod() == 'POST') {
        $em = $doctrine->getManager();
        $em->remove($user);
        $em->flush();
    
        return $this->redirectToRoute('app_applyshow');
    }
    
    return $this->render('deleteApply.html.twig', [
        'users' => $user,
    ]);
}
     
}