<?php

namespace App\Controller;

use App\Entity\Stat;
use App\Form\StatType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StatController extends AbstractController
{
    /**
     * Affiche la liste des stats
     * @Route("/stats", name="stat_index", methods={"GET"})
     */
    public function index()
    {
        return $this->render('stat/index.html.twig', [
            'controller_name' => 'StatController',
        ]);
    }

    /**
     * Affiche une stat
     * @Route("/stat/{stat}", name="stat_show", methods={"GET"}, requirements={"stat"="\d+"})
     * @param Stat $stat
     */
    public function show(Stat $stat)
    {
    }

    /**
     * Affiche le formulaire de création de stat
     * @Route("/stat/new", name="stat_new", methods={"GET", "POST"})
     */
    public function new(Request $request)
    {

        $stat = new Stat();
        $form = $this->createForm(StatType::class, $stat);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $stat = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($stat);
            $entityManager->flush();

            return $this->redirectToRoute('stat_index');
        }

        return $this->render('stat/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Traite la requête d'un formulaire de création de stat
     * @Route("/stat", name="stat_create", methods={"POST"})
     */
    public function create()
    {
    }

    /**
     * Affiche le formulaire d'édition d'une stat (GET)
     * Traite le formulaire d'édition d'une stat (POST)
     * @Route("/stat/{stat}/edit", name="stat_edit", methods={"GET", "POST"})
     * @param Stat $stat
     */
    public function edit(Stat $stat)
    {
    }

    /**
     * Supprime une stat
     * @Route("/stat/{stat}", name="stat_delete", methods={"DELETE"})
     * @param Stat $country
     */
    public function delete(Stat $stat)
    {
    }
}
