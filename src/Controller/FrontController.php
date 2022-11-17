<?php

namespace App\Controller;

use App\Entity\Tache;
use App\Form\TacheType;
use App\Repository\TacheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/front')]
class FrontController extends AbstractController
{
    #[Route('/', name: 'app_front_index', methods: ['GET'])]
    public function index(TacheRepository $tacheRepository): Response
    {
        return $this->render('tache/front.html.twig', [
            'taches' => $tacheRepository->findAll(),
        ]);
    }


    #[Route('/{id}', name: 'app_tache_show_front', methods: ['GET'])]
    public function show(Tache $tache): Response
    {
        return $this->render('tache/frontshow.html.twig', [
            'tache' => $tache,
        ]);
    }

}
