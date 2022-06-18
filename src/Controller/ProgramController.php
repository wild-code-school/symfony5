<?php

namespace App\Controller;

use App\Form\ProgramType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use ContainerVpZSsI4\getSaisonRepositoryService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ProgramRepository;
use App\Entity\Program;
use App\Entity\Episode;
use App\Entity\Saison;



#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();
        return $this->render('Wild/index.html.twig', ['programs' => $programs,]);
    }

    #[Route ('/new', name: 'new')]
    public function new(Request $request, ProgramRepository $programRepository): Response
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $programRepository->add($program, true);

            return $this->redirectToRoute('program_index');
        }
        return $this->renderForm('program/new.html.twig', [
            'program' => $program,
            'form' => $form
        ]);

    }

    #[Route('/{program_id}', methods: ['GET'], name: 'show')]
    #[Entity('program', options: ['id' => 'program_id'])]
    public function show(Program $program): Response
    {

        if (!$program) {

            throw $this->createNotFoundException(
                'no program with id : ' . $id . ' found in program\'s table.'
            );
        }
        return $this->render('Wild/show.html.twig', ['program' => $program]);
    }

    #[Route('/{program_id}/season/{season_id}', name: 'season_show', methods: ['GET'])]
    #[Entity('program', options: ['id' => 'program_id'])]
    #[Entity('season', options: ['id' => 'saison_id'])]
    public function showSeason(Saison $saison, Program $program): Response
    {

        return $this->render('Wild/season_show.html.twig', ['saison' => $saison]);
    }

    #[Route('/{program_id}/season/{season_id}/episode/{episode_id}', name: 'episode_show', methods: ['GET'])]
    #[Entity('program', options: ['id' => 'program_id'])]
    #[Entity('season', options: ['id' => 'saison_id'])]
    #[Entity('episode', options: ['id' => 'episode_id'])]
    public function showEpisode(Episode $episode, Saison $saison, Program $program): Response
    {

        return $this->render('Wild/episode_show.html.twig', ['episode' => $episode]);
    }

}

