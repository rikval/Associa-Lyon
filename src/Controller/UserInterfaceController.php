<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;



class UserInterfaceController extends AbstractController
{

    /**
     * @Route("/userui", name="userui")
     */
    public function userui(): Response
    {

        return $this->render('userui/userui.html.twig');
    }
}
