<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     * @IsGranted("ROLE_ADMIN")
     * @param UserRepository $userRepository
     * @return Response
     */
    public function index(UserRepository $userRepository): Response
    {

        $userDetails = $userRepository->findAll();
        dump($userDetails);

        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'userDetails' => $userDetails
        ]);
    }
}
