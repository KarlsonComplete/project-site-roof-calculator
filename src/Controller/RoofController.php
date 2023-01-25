<?php

namespace App\Controller;

use App\Repository\CoatingRepository;
use App\Repository\MaterialTypeRepository;
use App\Repository\TypeOfSelectMaterialRepository;
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
    public function index(Request $request,CoatingRepository $coatingRepository, MaterialTypeRepository $materialTypeRepository, TypeOfSelectMaterialRepository $typeOfSelectMaterialRepository): Response
    {
        $selected_rows= $request->getContent();
        parse_str($selected_rows,$output);

        return new Response($this->twig->render('roof/index.html.twig',[
            'coatings' => $coatingRepository->findAll(),
            'rows' => false,
            'types' => false,
        ]));

    }

    #[Route('/roof/ajax', name: 'app_roof_ajax')]
    public function ajax(Request $request, MaterialTypeRepository $materialTypeRepository, TypeOfSelectMaterialRepository $typeOfSelectMaterialRepository, CoatingRepository $coatingRepository): Response
    {
        $rows = null;
        $types = null;
        $selected= $request->getContent();
        parse_str($selected,$output);
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