<?php

namespace App\Controller;

use App\Entity\BusinessHours;
use App\Entity\Structure;
use App\Form\UpdateBusinessHoursType;
use App\Form\UpdateStructureInfoType;
use App\Repository\BusinessHoursRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class DashboardController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    /**
     * @Route("/homePro", name="homePro")
     */
    public function homePro(){
        return $this->render('dashboard/indexPro.html.twig', [

        ]);
    }

    /**
     * @Route("/dashboard", name="dashboard")
     * @IsGranted("ROLE_ADMIN")
     * @param UserRepository $userRepository
     * @param BusinessHoursRepository $businessHoursRepository
     * @return Response
     */
    public function index(UserRepository $userRepository, BusinessHoursRepository $businessHoursRepository): Response
    {
        $idUser = $this->getUser()->getId();
        $userStructureId = $this->getUser()->getStructure();

        $userDetails = $userRepository->findBy(['id' => $idUser]);
        $businessHours = $businessHoursRepository->findBy(['structure' =>  $userStructureId]);


        return $this->render('dashboard/index.html.twig', [
            'userDetails' => $userDetails,
            'businessHours' => $businessHours
        ]);
    }

    /**
     * * @Route("/updateStructureDetails/{id}", name="update_structure_details")
     * @IsGranted("ROLE_ADMIN")
     * @param Structure $structure
     * @return RedirectResponse|Response
     */
    public function updateStructureDetails(Structure $structure, Request $req){

        $form = $this->createForm(UpdateStructureInfoType::class, $structure);
        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($structure);
            $this->em->flush();

            $this->addFlash('success', 'Détails de la struture bien été modifiées.');
            return $this->redirectToRoute('dashboard');
        }

        return $this->render('dashboard/updateStructureDetails.html.twig', [
            "user" => $this->getUser(),
            "form" => $form->createView()

        ]);
    }

    /**
     * @Route("/updateBusinessHours/{id}", name="update_business_hours")
     * @IsGranted("ROLE_ADMIN")
     * @param BusinessHours $businessHours
     * @param Request $req
     * @return RedirectResponse|Response
     */
    public function updateBusinessHours(BusinessHours $businessHours, Request $req){


        $businessHour = $businessHours;

        $form = $this->createForm(UpdateBusinessHoursType::class, $businessHours);
        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($businessHours);
            $this->em->flush();

            $this->addFlash('success', 'Horaires bien été modifiés.');
            return $this->redirectToRoute('dashboard');
        }

        return $this->render('dashboard/updateBusinessHours.html.twig', [
            "user" => $this->getUser(),
            "form" => $form->createView(),
            "businessHour" => $businessHour

        ]);
    }
}
