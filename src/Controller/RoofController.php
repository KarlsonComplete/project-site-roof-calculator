<?php

namespace App\Controller;


use App\Entity\RoofList;
use App\Form\RoofType;
use App\Repository\CoatingRepository;
use App\Repository\MaterialTypeRepository;
use App\Repository\TypeOfSelectMaterialRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class RoofController extends AbstractController
{


    #[Route('/roof', name: 'app_roof')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $roof = new RoofList();

        $form = $this->createForm(RoofType::class,$roof);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($roof);
            $em->flush();

            $this->addFlash('success', 'Thanks for your message. We\'ll get back to you shortly.');
            return $this->redirectToRoute('app_roof');
        }


        return $this->render('roof/index.html.twig', [
            'form' => $form->createView()
        ]);

    }

    #[Route('/roof/ajax', name: 'app_roof_ajax')]
    public function ajax(Request $request, MaterialTypeRepository $materialTypeRepository, TypeOfSelectMaterialRepository $typeOfSelectMaterialRepository, CoatingRepository $coatingRepository): Response
    {
        $rows = null;
        $types = null;
        $selected = $request->getContent();
        parse_str($selected, $output);
        switch ($output['action']) {
            case "showMaterialForInsert":
                $rows = $materialTypeRepository->SearchForIdenticalId($output['id_coating']);

                break;
            case "showCityForInsert":
                $types = $typeOfSelectMaterialRepository->SearchForIdenticalId($output['id_material']);

                break;
        }
        return $this->redirectToRoute('app_roof',
            ['rows' => $rows, 'types' => $types]);

    }

}