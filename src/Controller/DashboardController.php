<?php

namespace App\Controller;

use App\Entity\BusinessHours;
use App\Repository\BusinessHoursRepository;
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
     * @param BusinessHoursRepository $businessHoursRepository
     * @return Response
     */
    public function index(UserRepository $userRepository, BusinessHoursRepository $businessHoursRepository): Response
    {

        $userDetails = $userRepository->findAll();
        $businessHours = $businessHoursRepository->findBy(['structure' => 1]);

        dump($userDetails);

        return $this->render('dashboard/index.html.twig', [
            'userDetails' => $userDetails,
            'businessHours' => $businessHours
        ]);
    }
}
