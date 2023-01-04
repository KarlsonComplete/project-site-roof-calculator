<?php

namespace App\Controller;

use App\Entity\MaterialType;
use App\Repository\CoatingRepository;
use App\Repository\MaterialTypeRepository;
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
    public function index(CoatingRepository $coatingRepository, MaterialTypeRepository $materialTypeRepository): Response
    {
        return new Response($this->twig->render('roof/index.html.twig', [
           'coatings' => $coatingRepository->findAll(),
            'materials' => $materialTypeRepository->findAll()



            // 'controller_name' => 'RoofController',
        ]));
    }

}