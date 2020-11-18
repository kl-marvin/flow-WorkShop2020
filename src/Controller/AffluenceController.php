<?php

namespace App\Controller;

use App\Entity\Affluence;
use App\Form\AddAffluenceType;
use App\Repository\AffluenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AffluenceController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/affluence", name="affluence_dashboard")
     * @IsGranted("ROLE_ADMIN")
     * @param Request $req
     * @param AffluenceRepository $affluenceRepository
     * @return Response
     */
    public function index(Request $req, AffluenceRepository $affluenceRepository): Response
    {
        $structure = $this->getUser()->getStructure();
        $affluence = new Affluence();

        $affluencesData = ($affluenceRepository->findDataByStructureId($structure->getId()));

        $form = $this->createForm(AddAffluenceType::class, $affluence);
        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid()){

            $affluence->setStructure($structure);
            $this->em->persist($affluence);
            $this->em->flush();

            $this->addFlash('success', 'Affluence bien été ajoutée !');

            return $this->redirectToRoute('affluence_dashboard');
        }

        return $this->render('affluence/index.html.twig', [
            "user" => $this->getUser(),
            "form" => $form->createView(),
            "affluences" => $affluencesData
        ]);
    }
}
