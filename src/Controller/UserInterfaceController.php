<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\InitiativeRepository;
use App\Repository\UserRepository;



class UserInterfaceController extends AbstractController
{

    /**
     * @Route("/userui", name="userui")
     */
    public function index(): Response
    {

        $initiatives = $this->getUser()->getInitiatives();

        $propositions = $this->getUser()->getPropositions();
        
        return $this->render('userui/userui.html.twig', [
            'initiatives' => $initiatives,
            'propositions' => $propositions,
            'user' => $this->getUser()
        ]);
    }

}
