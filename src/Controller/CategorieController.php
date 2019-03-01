<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\CategorieRepository;
use App\Entity\Categorie;


/**
 * @Route("/categorie")
 */
class CategorieController extends AbstractController
{

    /**
     * @Route("/", name="categorie")
     */
    public function index(CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->findAll();

        return $this->render('categorie/index.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/{id}", name="categorie_show", methods={"GET"})
     */
    public function show(Categorie $categorie): Response
    {
        dump($categorie);

        return $this->render('categorie/show.html.twig', [
            'categorie' => $categorie,
        ]);
    
    } 
}
