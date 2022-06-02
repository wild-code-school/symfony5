<?php

namespace App\Controller;


use App\Repository\EpisodeRepository;
use App\Repository\SaisonRepository;
use ContainerVpZSsI4\getSaisonRepositoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Program;
use App\Repository\ProgramRepository;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();
        return $this->render('Wild/index.html.twig', ['programs' => $programs,]);
    }

    #[Route('/{id}', methods: ['GET'], name: 'show')]
    public function show(int $id, ProgramRepository $programRepository, SaisonRepository $saisonRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);
        $saisons = $saisonRepository->findBy(['program' => $program]);
        if (!$program) {
            throw $this->createNotFoundException(
                'no program with id : ' . $id . ' found in program\'s table.'
            );
        }

        return $this->render('Wild/show.html.twig', ['program' => $program, 'saisons' => $saisons]);
    }

    #[Route('/{programId}/season/{seasonId}', methods: ['GET'], name: 'season_show')]
    public function showSeason(int $programId, int $seasonId, ProgramRepository $programRepository, SaisonRepository $saisonRepository, EpisodeRepository $episodeRepository)
    {

        $program = $programRepository->findOneBy(['id' => $programId]);
        $saisons = $saisonRepository->findBy(['id' => $seasonId]);
        $episode = $episodeRepository->findAll();

        return $this->render('Wild/season_show.html.twig', ['program' => $program, 'saisons' => $saisons, 'episode' => $episode]);
    }

}

