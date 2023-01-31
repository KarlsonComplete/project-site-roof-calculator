<?php

namespace App\Controller;


use App\Form\RoofType;
use App\Repository\CoatingRepository;
use App\Repository\MaterialTypeRepository;
use App\Repository\TypeOfSelectMaterialRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class RoofController extends AbstractController
{


    #[Route('/roof', name: 'app_roof')]
    public function index(Request $request, CoatingRepository $coatingRepository): Response
    {
        /*   if ($request->query->get('action') === null) {
               return new Response($this->twig->render('roof/index.html.twig', [
                   'coatings' => $coatingRepository->findAll(),
                   'rows'=>false,
               ]));
           } else {
               switch ($request->query->get('action')) {
                   case "showMaterialForInsert":
                       $rows = $materialTypeRepository->SearchForIdenticalId($request->query->get('id_coating'));

                       return new Response($this->render('roof/index.html.twig',[
                           'coatings' => $coatingRepository->findAll(),

                      break;
                   case "showCityForInsert":
                       $types = $typeOfSelectMaterialRepository->SearchForIdenticalId($request->query->get('id_material'));
                       return new Response($this->twig->render('roof/index.html.twig', [
                           'coatings' => $coatingRepository->findAll(),
                           'rows' => false,
                           'types' => $types,
                       ]));
                       break;
               }


           }
   */

        $form = $this->createForm(RoofType::class,[
            'coating' => $coatingRepository->find(2)]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dd($form->getData());
        }
        return $this->render('roof/index.html.twig', [
            'form' => $form->createView(),
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