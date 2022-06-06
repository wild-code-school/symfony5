<?php

namespace App\Controller;


use App\Entity\Saison;
use App\Repository\EpisodeRepository;
use App\Repository\SaisonRepository;
use ContainerVpZSsI4\getSaisonRepositoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
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

    #[Route('/{program_id}', methods: ['GET'], name: 'show')]
    #[Entity('program', options: ['id' => 'program_id'])]
    public function show(Program $program, SaisonRepository $saisonRepository): Response
    {

        $saisons = $saisonRepository->findBy(['program' => $program]);
        if (!$program) {
            throw $this->createNotFoundException(
                'no program with id : ' . $id . ' found in program\'s table.'
            );
        }
             return $this->render('Wild/show.html.twig', ['program' => $program, 'saisons' => $saisons]);
    }

    #[Route('/{program_id}/season/{season_id}', methods: ['GET'], name: 'season_show')]
    public function showSeason(Program $program, Saison $saison)
    {

        return $this->render('Wild/season_show.html.twig', ['program' => $program, 'saisons' => $saisons, 'episode' => $episode]);
    }

}

