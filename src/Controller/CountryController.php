<?php

namespace App\Controller;

use App\Entity\Country;
use App\Form\CountryType;
use App\Repository\CountryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CountryController extends AbstractController
{
    /**
     * Affiche la liste des pays
     * @Route("/countries", name="country_index", methods={"GET"})
     */
    public function index()
    {
        return $this->render('country/index.html.twig', [
            'controller_name' => 'CountryController',
        ]);
    }

    /**
     * @Route("/pays/{id}", name="country_show", methods={"GET"})
     */
    public function show(Country $country): Response
    {
        return $this->render('country/show.html.twig', [
            'country' => $country,
        ]);
    }

    /**
     * Affiche le formulaire de création de pays
     * @Route("/country/new", name="country_new", methods={"GET", "POST"})
     */
    public function new(Request $request)
    {

        $country = new Country();
        $form = $this->createForm(CountryType::class, $country);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $country = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($country);
            $entityManager->flush();

            return $this->redirectToRoute('country_index');
        }

        return $this->render('country/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Traite la requête d'un formulaire de création de pays
     * @Route("/country", name="country_create", methods={"POST"})
     */
    public function create()
    {
    }

    /**
     * Affiche le formulaire d'édition d'un pays (GET)
     * Traite le formulaire d'édition d'un pays (POST)
     * @Route("/country/{country}/edit", name="country_edit", methods={"GET", "POST"})
     * @param Country $country
     */
    public function edit(Country $country)
    {
    }

    /**
     * Supprime un pays
     * @Route("/country/{country}", name="country_delete", methods={"DELETE"})
     * @param Country $country
     */
    public function delete(Country $country)
    {
    }
}
