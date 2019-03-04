<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\PropositionRepository;



class HomeController extends AbstractController
{

    /**
     * @Route("/home", name="home")
     */
    public function home(PropositionRepository $propositionRepository): Response
    {

        return $this->render('home/home.html.twig', [
            'propositions' => $propositionRepository->findAll(),
            'user' => $this->getUser()
        ]);
    }
}

