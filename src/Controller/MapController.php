<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;



class MapController extends AbstractController
{

    /**
     * @Route("/map", name="map")
     */
    public function map(): Response
    {

        return $this->render('map/map.html.twig');
    }
}
