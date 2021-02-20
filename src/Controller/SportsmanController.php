<?php

namespace App\Controller;

use App\Entity\Sport;
use App\Entity\Sportsman;
use App\Form\CheckMailType;
use App\Form\SportsmanType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/")
 */
class SportsmanController extends AbstractController
{
    /**
     * @Route("/sportsman", name="sportsman_index", methods={"GET"})
     */
    public function index(): Response
    {
        $sportsmen = $this->getDoctrine()
            ->getRepository(Sportsman::class)
            ->findAll();

        return $this->render('sportsman/index.html.twig', [
            'sportsmen' => $sportsmen,
        ]);
    }

    /**
     * @Route("/", name="sportsman_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sports = $this->getDoctrine()
        ->getRepository(Sport::class)
        ->findAll();
        $sportsman = new Sportsman();
        $form = $this->createForm(CheckMailType::class, $sportsman);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $EmailDataInDB = $this->getDoctrine()->getRepository(Sportsman::class)->findOneBy([
                "Email" => $sportsman->getEmail() ]);
            if ($EmailDataInDB) {
                return $this->redirectToRoute('sport_practice_by_sportsman_index');
            }

            return $this->redirectToRoute('sport_practice_by_sportsman_new');
        }

        return $this->render('sportsman/new.html.twig', [
            'sportsman' => $sportsman,
            'form' => $form->createView(),
            'sports' => $sports
        ]);
    }

    /**
     * @Route("/sportsman/{ID}", name="sportsman_show", methods={"GET"})
     */
    public function show(Sportsman $sportsman): Response
    {
        return $this->render('sportsman/show.html.twig', [
            'sportsman' => $sportsman,
        ]);
    }

    /**
     * @Route("/sportsman/{ID}/edit", name="sportsman_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sportsman $sportsman): Response
    {
        $form = $this->createForm(SportsmanType::class, $sportsman);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sportsman_index');
        }

        return $this->render('sportsman/edit.html.twig', [
            'sportsman' => $sportsman,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/sportsman/{ID}", name="sportsman_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Sportsman $sportsman): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sportsman->getID(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sportsman);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sportsman_index');
    }
}
