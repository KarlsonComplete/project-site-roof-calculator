<?php

namespace App\Controller;

use App\Repository\CoatingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class RoofController extends AbstractController
{
    private Environment $twig;
    private $entityManager;

    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
    }

    #[Route('/roof', name: 'app_roof')]
    public function index(CoatingRepository $coatingRepository): Response
    {
        return new Response($this->twig->render('roof/index.html.twig', [
           'coatings' => $coatingRepository->findAll(),
            // 'controller_name' => 'RoofController',
        ]));
    }

}