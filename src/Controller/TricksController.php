<?php

namespace App\Controller;

use App\Entity\Tricks;
use App\Form\MediaType;
use App\Form\TricksType;
use App\Repository\TricksRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tricks')]
class TricksController extends AbstractController
{
    #[Route('/', name: 'app_tricks_index', methods: ['GET'])]
    public function index(TricksRepository $tricksRepository): Response
    {
        return $this->render('tricks/index.html.twig', [
            'tricks' => $tricksRepository->findAll(),
        ]);
    }

    #[Route('/ajouter', name: 'app_tricks_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $trick = new Tricks();
        $form = $this->createForm(TricksType::class, $trick);
        $formMedia = $this->createForm(MediaType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trick->setUser($this->getUser());
            $trick->setCreatedAt(new \DateTimeImmutable());
            $cheminDossier = '/assets/images/triks/'.$trick->getName();

            //création du dossier
            if (!is_dir('../public'.$cheminDossier)) {
                mkdir('../public'.$cheminDossier,0777);
                mkdir('../public'.$cheminDossier . '/media');
            }
            $filePicture = $form->get('pictureStorage')->getData();
            //ajout de l'image principale si elle existe sinon ajout d'une image par défaut
            if ($filePicture) {
                $filePicture->move('../public'.$cheminDossier, '/cover.jpg');
            }else{
                copy('../public/assets/images/cover.jpg', '../public'.$cheminDossier.'/cover.jpg');
            }
            $trick->setPictureStorage($cheminDossier.'/cover.jpg');
            if($trick->getMedia()){
                $i =0;
               foreach ($trick->getMedia() as $media) {

                   $media->setTricks($trick);
                   $media->setCreatedAt(new \DateTimeImmutable());
                   $media->setUser($this->getUser());

                   if ($media->IsVideo()){
                       $iframe = $media->getVideo();
                       $regex = '/https[^"]+/';
                       preg_match($regex,$iframe,$matches);
                        $media->setVideo($matches[0]);
                       $media->setPicture(null);
                   } else {
                       $file = $request->files->get('tricks')['media'][$i]['picture'];
                       $media->setPicture($cheminDossier.'/media/'.$media->getName().'.'.$file->guessExtension());
                       $file->move('../public'.$cheminDossier.'/media/', $media->getName().'.'.$file->guessExtension());
                       $media->setIsVideo(false);
                   }
                   $i++;
                   $entityManager->persist($media);
               }
            }
           $entityManager->persist($trick);
           $entityManager->flush();

            return $this->redirectToRoute('app_tricks_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tricks/new.html.twig', [
            'trick' => $trick,
            'form' => $form,
            'formMedia' => $formMedia,
        ]);
    }

    #[Route('/{id}', name: 'app_tricks_show', methods: ['GET'])]
    public function show(Tricks $trick): Response
    {
        $medias = $trick->getMedia();
        return $this->render('tricks/show.html.twig', [
            'trick' => $trick,
            'medias' => $medias,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tricks_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tricks $trick, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TricksType::class, $trick);
        $formMedia = $this->createForm(MediaType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trick->setUpdatedAt(new \DateTimeImmutable());
            $entityManager->flush();

            return $this->redirectToRoute('app_tricks_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tricks/edit.html.twig', [
            'trick' => $trick,
            'form' => $form,
            'formMedia' => $formMedia,
        ]);
    }

    #[Route('/{id}', name: 'app_tricks_delete', methods: ['POST'])]
    public function delete(Request $request, Tricks $trick, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trick->getId(), $request->request->get('_token'))) {
            $entityManager->remove($trick);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tricks_index', [], Response::HTTP_SEE_OTHER);
    }
}
