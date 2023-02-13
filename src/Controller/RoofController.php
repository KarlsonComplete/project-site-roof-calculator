<?php

namespace App\Controller;


use App\Entity\Coating;
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
        $materials = null;
              if ($request->isXmlHttpRequest()) {
                    $materials = $materialTypeRepository->SearchForIdenticalId($request->request->get('id_coating'));
                    $data = $this->twig->render('roof/select.html.twig', ['materials' => $materials]);
                    $data_new = ['materials' => $materials];
                 /*   dump($data_new);*/
                    $json = $this->json(['options' => $data_new]);
                  //  dump($json);

         return  new  Response($this->json(['options' => $data]));
                }

        return $this->render('roof/index.html.twig',
            [
                'coatings' => $coatings,
               /* 'materials' => $materials,*/
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