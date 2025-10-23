<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\BatimentOmarCherif;
use App\Form\AddeditBatimentType;
use App\Repository\BatimentOmarCherifRepository;
use Doctrine\ORM\EntityManagerInterface;

final class BatimentOmarCherifController extends AbstractController
{
    #[Route('/batiment/omar/cherif', name: 'app_batiment_omar_cherif')]
    public function index(): Response
    {
        return $this->render('batiment_omar_cherif/index.html.twig', [
            'controller_name' => 'BatimentOmarCherifController',
        ]);
    }

    #[Route('/batiment/list', name: 'app_batiment_list')]
    public function list(BatimentOmarCherifRepository $batimentRepository): Response
    {   
        $batimentsDB = $batimentRepository->findAll();
        return $this->render('batiment_omar_cherif/list.html.twig', [
            'batiments' => $batimentsDB,
        ]);
    }

    #[Route('/batiment/details/{id}', name: 'app_batiment_details')]
    public function details($id, BatimentOmarCherifRepository $batimentRepository): Response
    {
        $batiment = $batimentRepository->find($id);

        return $this->render('batiment_omar_cherif/details.html.twig', [
            "batiment" => $batiment,
            "title" => "Batiment Details"
        ]);
    }

    #[Route("/batiment/search/{name}", name:"app_batiment_search")]
    public function searchBatiment($name, BatimentOmarCherifRepository $batimentRepository): Response
    {
        $batiment = $batimentRepository->findOneBy(['nom' => $name]);

        return $this->render('batiment_omar_cherif/details.html.twig', [
            "batiment" => $batiment,
            "title" => "Search Batiment",
        ]);
    }

    #[Route('/batiment/create', name:'app_batiment_create')]
    public function createBatiment(Request $request, EntityManagerInterface $em): Response
    {
        $batiment = new BatimentOmarCherif();
        $form = $this->createForm(AddEditBatimentType::class, $batiment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($batiment);
            $em->flush();
            return $this->redirectToRoute('app_batiment_list');
        }

        return $this->render('batiment_omar_cherif/form.html.twig', [
            "title" => "Create Batiment",
            "form" => $form
        ]);
    }

    #[Route('/batiment/update/{id}', name:'app_batiment_update')]
    public function updateBatiment($id, Request $request, BatimentOmarCherifRepository $batimentRepository, EntityManagerInterface $em): Response
    {
        $batiment = $batimentRepository->find($id);
        $form = $this->createForm(AddEditBatimentType::class, $batiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() ) {
            $em->flush();
            return $this->redirectToRoute('app_batiment_list');
        }

        return $this->render('batiment_omar_cherif/form.html.twig', [
            "title" => "Update Batiment",
            "form" => $form
        ]);
    }

    #[Route('/batiment/delete/{id}', name:'app_batiment_delete')]
    public function deleteBatiment($id, EntityManagerInterface $em, BatimentOmarCherifRepository $batimentRepository): Response
    {
        $batiment = $batimentRepository->find($id);
        if ($batiment) {
            $em->remove($batiment);
            $em->flush();
        }
        return $this->redirectToRoute('app_batiment_list');
    }
}
