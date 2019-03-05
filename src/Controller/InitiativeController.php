<?php

namespace App\Controller;

use App\Entity\Initiative;
use App\Form\InitiativeType;
use App\Repository\InitiativeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\CategorieRepository;


/**
 * @Route("/initiative")
 */
class InitiativeController extends AbstractController
{

    private $categorieRepository;

    public function __construct(CategorieRepository $categorieRepository) {
        $this->categorieRepository = $categorieRepository;
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/", name="initiative_index", methods={"GET"})
     */
    public function index(InitiativeRepository $initiativeRepository): Response
    {

        $initiatives = $initiativeRepository->findAll();
        $categories = $this->categorieRepository->findAll();
        
        return $this->render('initiative/index.html.twig', [
            'initiatives' => $initiatives,
            'user' => $this->getUser(),
            'categories' => $categories
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/new", name="initiative_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $initiative = new Initiative();
        $form = $this->createForm(InitiativeType::class, $initiative);
        $form->handleRequest($request);

        $initiative->setUser($this->getUser());

        if ($form->isSubmitted() && $form->isValid()) {
            if ( $initiative->getImg()){
                $file = $initiative->getImg();
                $fileName = md5(uniqid()). '.' .$file->guessExtension();
                $file->move($this->getParameter('updload_directory'), $fileName);
                $initiative->setImg($fileName);

            }            

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($initiative);
            $entityManager->flush();

            return $this->redirectToRoute('userui');
        }

        return $this->render('initiative/new.html.twig', [
            'initiative' => $initiative,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="initiative_show", methods={"GET"})
     */
    public function show(Initiative $initiative): Response
    {
        return $this->render('initiative/show.html.twig', [
            'initiative' => $initiative,
            'user' => $this->getUser()
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/{id}/edit", name="initiative_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Initiative $initiative): Response
    {
        if ($this->getUser()->getId() !== $initiative->getUser()->getId()) {
            return new Response('Vous n\'êtes pas autorisé à modifer cette initiative');
        }
        $form = $this->createForm(InitiativeType::class, $initiative);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ( $initiative->getImg()){
                $file = $initiative->getImg();
                $fileName = md5(uniqid()). '.' .$file->guessExtension();
                $file->move($this->getParameter('updload_directory'), $fileName);
                $initiative->setImg($fileName);

            }
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('userui', [
                'id' => $initiative->getId(),
            ]);
        }

        return $this->render('initiative/edit.html.twig', [
            'initiative' => $initiative,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/{id}", name="initiative_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Initiative $initiative): Response
    {
        if ($this->getUser()->getId() !== $initiative->getUser()->getId()) {
            return new Response( 'Vous n\'êtes pas autorisé à supprimer cette initiative');
        }

        if ($this->isCsrfTokenValid('delete'.$initiative->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($initiative);
            $entityManager->flush();
        }

        return $this->redirectToRoute('userui');
    }
}
