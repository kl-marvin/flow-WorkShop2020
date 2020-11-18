<?php

namespace App\Controller;

use App\Entity\Search;
use App\Entity\Structure;
use App\Entity\User;
use App\Form\SearchFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param Request $req
     * @return Response
     */
    public function index(Request $req): Response
    {
        $q = new Search();
        $form = $this->createForm(SearchFormType::class, $q, ["action" => '/search']);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $name = $form->getData()['name'];
        }
        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),

        ]);
    }

    /**
     * @param Request $req
     * @Route("/search", name="search", methods={"POST"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getPostedData(Request $req)
    {
        $form = $this->createForm(SearchFormType::class);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {

            $name = $form->getData()['name'];// on récupère les données du formulaire sans passé par une
            // entité (filter_input)
            if ($name != "") {
                $results = $this->getDoctrine()
                    ->getRepository(User::class)
                    ->search('%' . $name . '%');

                $message = "";
                if ($results == []) {
                    $message = "Pas de résultat pour '$name'. ";
                }

                dump($results);

                return $this->render('dashboard/resulat.html.twig', [
                    'results' => $results,
                    'message' => $message,
                    'form' => $form->createView(),
                ]);
            }
        }
    }
}






