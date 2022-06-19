<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Repository\ActorRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/actor', name: 'app_')]
class ActorController extends AbstractController
{
    #[Route('/', name: 'actor')]
    public function index(ActorRepository $actorRepository): Response
    {

        $actor = $actorRepository->findAll();
        return $this->render('actor/index.html.twig', [
            'actors' => $actor
        ]);
    }

    #[Route('/{id}', name: 'actor_show')]
    #[Entity('actor', options: ['id' => 'actor_id'])]
    public function showActor(Actor $actor): Response
    {

        return $this->render('actor/actor_show.html.twig', [
            'actor' => $actor,
        ]);
    }
}
