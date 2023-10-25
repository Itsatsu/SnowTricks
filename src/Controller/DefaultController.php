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

    #[Route('/404', name: 'app_error')]
    public function error(): Response
    {
        $this->addFlash('error', 'La page demandée n\'existe pas.');
        return $this->redirectToRoute('app_default', [], Response::HTTP_SEE_OTHER);
    }

}

