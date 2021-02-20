<?php

namespace App\Controller;

use App\Entity\Sport;
use App\Entity\SportPracticeBySportsman;
use App\Form\SportType;
use App\Form\AddSportType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/sport")
 */
class SportController extends AbstractController
{
    /**
     * @Route("/", name="sport_index", methods={"GET"})
     */
    public function index(): Response
    {
        $sports = $this->getDoctrine()
            ->getRepository(Sport::class)
            ->findAll();

        return $this->render('sport/index.html.twig', [
            'sports' => $sports,
        ]);
    }

    /**
     * @Route("/new", name="sport_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sport = new Sport();
        $form = $this->createForm(AddSportType::class, $sport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $SportDataInDB = $this->getDoctrine()->getRepository(Sport::class)->findOneBy([
                "Loisir" => $sport->getLoisir() ]);
            if ($SportDataInDB) {
                return $this->redirectToRoute('sport_practice_by_sportsman_new');
            }
            $entityManager->persist($sport);
            $entityManager->flush();

            return $this->redirectToRoute('sport_practice_by_sportsman_new');
        }

        return $this->render('sport/new.html.twig', [
            'sport' => $sport,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{ID}", name="sport_show", methods={"GET"})
     */
    public function show(Sport $sport): Response
    {
        return $this->render('sport/show.html.twig', [
            'sport' => $sport,
        ]);
    }

    /**
     * @Route("/{ID}/edit", name="sport_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sport $sport): Response
    {
        $form = $this->createForm(SportType::class, $sport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sport_index');
        }

        return $this->render('sport/edit.html.twig', [
            'sport' => $sport,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{ID}", name="sport_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Sport $sport): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sport->getID(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sport);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sport_index');
    }
}
