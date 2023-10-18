<?php

namespace App\Controller;

use App\Repository\TricksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(TricksRepository $tricksRepository): Response
    {
        $tricks = $tricksRepository->findAll();
        return $this->render('default/index.html.twig', [
            'tricks' => $tricks
        ]);
    }
}
