<?php

namespace App\Controller;

use App\Repository\CoatingRepository;
use App\Repository\MaterialTypeRepository;
use App\Repository\TypeOfSelectMaterialRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


class RoofController extends AbstractController
{

    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    #[Route('/roof', name: 'app_roof')]
    public function index(Request $request, EntityManagerInterface $em, CoatingRepository $coatingRepository, MaterialTypeRepository $materialTypeRepository, TypeOfSelectMaterialRepository $typeOfSelectMaterialRepository): Response
    {
        $coatings = $coatingRepository->findAll();

        if ($request->isXmlHttpRequest()) {
            if ($request->request->get('id_coating')){
                $materials = $materialTypeRepository->SearchForIdenticalId($request->request->get('id_coating'));

                return new  Response($this->twig->render('roof/select.html.twig', ['materials' => $materials]));
            }
            if ($request->request->get('id_material_type')){
                $materials_type  = $typeOfSelectMaterialRepository->SearchForIdenticalId($request->request->get('id_material_type'));

                return new Response($this->twig->render('/roof/material_type.html.twig', ['material_types' => $materials_type]));
            }
        }

        return $this->render('roof/index.html.twig',
            [
                'coatings' => $coatings,
            ]);
    }

}