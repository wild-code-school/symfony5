<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Program;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route ('/category', name: 'category_')]
class CategoryController extends AbstractController
{

    #[Route ('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('Category/index.html.twig', ['categories' => $categories,]);
    }

    #[Route ('/{categoryName}', methods: ['GET'], name: 'show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
    {

        $categories = $categoryRepository->findOneBy(['name' => $categoryName]);
        if (! $categories) {
            throw $this->createNotFoundException('Aucune catégorie nommée ainsi.');
        }
        $series = $programRepository->findBy(['category' => $categories]);

        return $this->render('Category/show.html.twig', ['series' => $series]);

    }

}