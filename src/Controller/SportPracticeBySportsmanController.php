<?php

namespace App\Controller;

use App\Entity\Sport;
use App\Form\QueryType;
use App\Entity\Sportsman;
use App\Entity\SportPracticeBySportsman;
use App\Form\SportPracticeBySportsmanType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SportPracticeBySportsmanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/")
 */
class SportPracticeBySportsmanController extends AbstractController
{

    /**
     * @Route("/list", name="sport_practice_by_sportsman_index", methods={"GET","POST"})
     */
    public function index(Request $request): Response
    {
        /*
        Récupère les données de tous les inscrits en fonction de leur pratique (sportif par sport par niveau)
        */
        $sportPractriceBySportsmen = $this->getDoctrine()
        ->getRepository(SportPracticeBySportsman::class)
        ->findAll();


        /*
        Création du form qui permet de trier parmi les inscrits par département, sport et niveau
        */
        $PotentialMatesData = new SportPracticeBySportsman();
        $Formulaire            = $this->createForm(
            QueryType::class,
            $PotentialMatesData
        );
        $Formulaire->handleRequest($request);
        
        if ($Formulaire->isSubmitted() && $Formulaire->isValid()) {
            $selectLoisir = $this->getDoctrine()->getRepository(Sport::class)->findOneBy([
                "Loisir" => $PotentialMatesData->getSportData()->getLoisir()]);
            $selectNiveau = $PotentialMatesData->getNiveau();
            $selectDepartement = $this->getDoctrine()->getRepository(Sportsman::class)->findBy([
                "Departement" => $PotentialMatesData->getSportsmanData()->getDepartement()]);
            $PotentialMates = $this->getDoctrine()
            ->getRepository(SportPracticeBySportsman::class)
            ->findBy([
                "SportData" => $selectLoisir,
                "Niveau" => $selectNiveau,
                "SportsmanData" => $selectDepartement
            ]);
            return $this->render(
                'sport_practice_by_sportsman/index.html.twig',
                [
                                'form'                        => $Formulaire->createView(),
                                'sport_practice_by_sportsmen' => $PotentialMates,
                            ]
            );
        }

        return $this->render(
            'sport_practice_by_sportsman/index.html.twig',
            [
                                'form'                        => $Formulaire->createView(),            
                                'sport_practice_by_sportsmen' => $sportPractriceBySportsmen
                        ]
        );
    }

    /**
     * @Route("/createProfil", name="sport_practice_by_sportsman_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $NewSportPracticeBySportsmanData = new SportPracticeBySportsman();
        $NewSportPracticeForm            = $this->createForm(
            SportPracticeBySportsmanType::class,
            $NewSportPracticeBySportsmanData
        );
        $NewSportPracticeForm->handleRequest($request);

        if ($NewSportPracticeForm->isSubmitted() && $NewSportPracticeForm->isValid()) {
            $SportsmanDataInDB = $this->getDoctrine()->getRepository(Sportsman::class)->findOneBy([
                "Email" => $NewSportPracticeBySportsmanData->getSportsmanData()->getEmail() ]);
            if ($SportsmanDataInDB) {
                $NewSportPracticeBySportsmanData->setSportsmanData($SportsmanDataInDB);
            }
            $SportDataInDB = $this->getDoctrine()->getRepository(Sport::class)->findOneBy([
                "Loisir" => $NewSportPracticeBySportsmanData->getSportData()->getLoisir() ]);
            if ($SportDataInDB) {
                $NewSportPracticeBySportsmanData->setSportData($SportDataInDB);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($NewSportPracticeBySportsmanData);
            $entityManager->flush();

            return $this->redirectToRoute('sport_practice_by_sportsman_index');
        }

        return $this->render(
            'sport_practice_by_sportsman/new.html.twig',
            [
                            'sport_practice_by_sportsman' => $NewSportPracticeBySportsmanData,
                            'form'                        => $NewSportPracticeForm->createView(),
                        ]
        );
    }

    /**
     * @Route("/{ID}", name="sport_practice_by_sportsman_show", methods={"GET"})
     */
    public function show(SportPracticeBySportsman $sportPracticeBySportsman): Response
    {
        return $this->render(
            'sport_practice_by_sportsman/show.html.twig',
            [
                            'sport_practice_by_sportsman' => $sportPracticeBySportsman,
                        ]
        );
    }

    /**
     * @Route("/{ID}/edit", name="sport_practice_by_sportsman_edit", methods={"GET","POST"})
     */
    public function edit(
        Request $request,
        SportPracticeBySportsman $sportPracticeBySportsman
    ): Response {
        $form = $this->createForm(
            SportPracticeBySportsmanType::class,
            $sportPracticeBySportsman
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sport_practice_by_sportsman_index');
        }

        return $this->render(
            'sport_practice_by_sportsman/edit.html.twig',
            [
                            'sport_practice_by_sportsman' => $sportPracticeBySportsman,
                            'form'                        => $form->createView(),
                        ]
        );
    }

    /**
     * @Route("/{ID}", name="sport_practice_by_sportsman_delete", methods={"DELETE"})
     */
    public function delete(
        Request $request,
        SportPracticeBySportsman $sportPracticeBySportsman
    ): Response {
        if ($this->isCsrfTokenValid(
            'delete' . $sportPracticeBySportsman->getID(),
            $request->request->get('_token')
        )) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sportPracticeBySportsman);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sport_practice_by_sportsman_index');
    }
}
