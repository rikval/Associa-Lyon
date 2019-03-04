<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\InitiativeRepository;



class MapController extends AbstractController
{

    private $initiativeRepository;

    public function __construct(InitiativeRepository $ir) {
        $this->initiativeRepository = $ir;
    }
    /**
     * @Route("/map", name="map")
     */
    public function map(): Response
    {

        $initiatives = $this->initiativeRepository->findAll();

        return $this->render('map/map.html.twig', [
            'initiatives' => $initiatives
        ]);
    }
}
