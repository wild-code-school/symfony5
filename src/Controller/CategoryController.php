<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CategoryType;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


#[Route ('/category', name: 'category_')]
class CategoryController extends AbstractController
{

    #[Route ('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('Category/index.html.twig', ['categories' => $categories,]);
    }

    #[Route ('/new', name: 'new')]
    public function new(Request $request, CategoryRepository $categoryRepository): Response
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $categoryRepository->add($category, true);
            return $this->redirectToRoute('category_index');
        }

        return $this->renderForm('Category/new.html.twig', [
            'form' => $form
        ]);
    }

    #[Route ('/{categoryName}', methods: ['GET'], name: 'show', requirements: ['id' => '\d+'])]
    public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
    {

        $categories = $categoryRepository->findOneBy(['name' => $categoryName]);
        if (!$categories) {
            throw $this->createNotFoundException('Aucune catégorie nommée ainsi.');
        }
        $series = $programRepository->findBy(['category' => $categories]);

        return $this->render('Category/show.html.twig', ['series' => $series]);

    }
}