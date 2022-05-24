<?php

namespace App\Controller;

use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {

        return $this->render('Wild/index.html.twig', ['website' => 'wild Series',]);
    }

    #[Route('/{id}', methods: ['GET'], requirements: ['id' => '\d'] ,name: 'show')]
    public function show(int $id): Response
    {

        return $this->render('Wild/show.html.twig', ['id' => $id,]);
}
}

