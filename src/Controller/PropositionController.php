<?php

namespace App\Controller;

use App\Entity\Proposition;
use App\Form\PropositionType;
use App\Repository\PropositionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/proposition")
 */
class PropositionController extends AbstractController
{
    /**
     * @Route("/", name="proposition_index", methods={"GET"})
     */
    public function index(PropositionRepository $propositionRepository): Response
    {
        return $this->render('proposition/index.html.twig', [
            'propositions' => $propositionRepository->findAll(),
            'user' => $this->getUser()
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/new", name="proposition_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $proposition = new Proposition();
        $form = $this->createForm(PropositionType::class, $proposition);
        $form->handleRequest($request);

        $proposition->setUser($this->getUser());

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($proposition);
            $entityManager->flush();

            return $this->redirectToRoute('proposition_index');
        }

        return $this->render('proposition/new.html.twig', [
            'proposition' => $proposition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="proposition_show", methods={"GET"})
     */
    public function show(Proposition $proposition): Response
    {
        return $this->render('proposition/show.html.twig', [
            'proposition' => $proposition,
            'user' => $this->getUser()
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/{id}/edit", name="proposition_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Proposition $proposition): Response
    {
        if ($this->getUser()->getId() !== $proposition->getUser()->getId()) {
            return new Response('pas auth');
        }
        $form = $this->createForm(PropositionType::class, $proposition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('proposition_index', [
                'id' => $proposition->getId(),
            ]);
        }

        return $this->render('proposition/edit.html.twig', [
            'proposition' => $proposition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/{id}", name="proposition_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Proposition $proposition): Response
    {
        if ($this->getUser()->getId() !== $proposition->getUser()->getId()) {
            return new Response('pas auth');
        }

        if ($this->isCsrfTokenValid('delete'.$proposition->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($proposition);
            $entityManager->flush();
        }

        return $this->redirectToRoute('proposition_index');
    }
}
