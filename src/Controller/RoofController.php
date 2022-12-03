<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
class RoofController extends AbstractController
{
    /*
    #[Route('/roof', name: 'app_roof')]
    public function index(): Response
    {
        return $this->render('roof/index.html.twig', [
            'controller_name' => 'RoofController',
        ]);
    }
    */
    #[Route('/', name: 'app_roof')]
    public function index(): Response
    {
        return new Response(<<<EOF
<html lang="en">
    <body>
       <img src="/images/under-construction.gif"  alt="Фото"/>
   </body>
</html>
EOF
        );
    }
}