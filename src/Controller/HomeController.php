<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\PropositionRepository;
use App\Repository\CategorieRepository;



class HomeController extends AbstractController
{

    private $propositionRepository;
    private $categorieRepository;

    public function __construct(PropositionRepository $propositionRepository, CategorieRepository $categorieRepository) {
        $this->propositionRepository = $propositionRepository;
        $this->categorieRepository = $categorieRepository;
    }
    /**
     * @Route("/")
     * @Route("/home", name="home")
     */
    public function home(): Response
    {

        return $this->render('home/home.html.twig', [
            'propositions' => $this->propositionRepository->findNb(3),
            'categories' => $this->categorieRepository->findAll(),
            'user' => $this->getUser()
        ]);
    }
}

