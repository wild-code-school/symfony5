<?php

namespace App\Controller;


use App\Repository\SaisonRepository;
use ContainerVpZSsI4\getSaisonRepositoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Program;
use App\Repository\ProgramRepository;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();
        return $this->render('Wild/index.html.twig', ['programs' => $programs,]);

    }

}