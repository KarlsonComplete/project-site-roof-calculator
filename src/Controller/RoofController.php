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
    public function index(CoatingRepository $coatingRepository, MaterialTypeRepository $materialTypeRepository, TypeOfSelectMaterialRepository $typeOfSelectMaterialRepository): Response
    {
        if(!empty($_GET['rows'])){
            return new Response($this->twig->render('roof/index.html.twig', [
                'rows' => $_GET['rows'],
                'types' => null,
                'coatings' => $coatingRepository->findAll(),
            ]));
        }

        if (empty($_GET['rows'])){
            return new Response($this->twig->render('roof/index.html.twig', [
                'rows' => null,
                'types' => null,
                'coatings' => $coatingRepository->findAll(),
            ]));
        }

        if(!empty($_GET['types'])){
            return new Response($this->twig->render('roof/index.html.twig', [
                'types' => $_GET['types'],
                'coatings' => $coatingRepository->findAll(),
            ]));
        }

        if (empty($_GET['types'])){
            return new Response($this->twig->render('roof/index.html.twig', [
                'types' => null,
                'coatings' => $coatingRepository->findAll(),
            ]));
        }

    }

    #[Route('/roof/ajax', name: 'app_roof_ajax')]
    public function ajax(Request $request, MaterialTypeRepository $materialTypeRepository, TypeOfSelectMaterialRepository $typeOfSelectMaterialRepository, CoatingRepository $coatingRepository):Response
    {
            $rows = null;
            $types = null;
      //  $selected = $request->query->get('action');
     //   if ($request->isXmlHttpRequest()) {
            switch ($_POST['action']) {
                case "showMaterialForInsert":
                  $rows = $materialTypeRepository->SearchForIdenticalId($_POST['id_coating']);

                break;
                case "showCityForInsert":
                    $types = $typeOfSelectMaterialRepository->SearchForIdenticalId($_POST['id_material']);

                break;
            }
     //   }

         /*   return new Response($this->twig->render('roof/ajax.html.twig', [
                'rows' => $rows,
                'coatings' => $coatingRepository->findAll(),
            ]));
            */

            return $this->redirectToRoute('app_roof', ['rows' => $rows,'types'=> $types]);

    }


}