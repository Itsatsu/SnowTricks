<?php

namespace App\Controller;

use App\Entity\Tricks;
use App\Form\CommentType;
use App\Form\MediaType;
use App\Form\TricksType;
use App\Repository\CommentRepository;
use App\Repository\TricksRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Sodium\add;

#[Route('/tricks')]
class TricksController extends AbstractController
{
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
                $filePicture->move('../public'.$cheminDossier, '/cover'.$filePicture->guessExtension());
                $trick->setPictureStorage($cheminDossier.'/cover'.$filePicture->guessExtension());
            }else{
                copy('../public/assets/images/cover.jpg', '../public'.$cheminDossier.'/cover.jpg');
                $trick->setPictureStorage($cheminDossier.'/cover.jpg');
            }

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
            $this->addFlash('success', 'Votre tricks a bien été ajouté');

            return $this->redirectToRoute('app_tricks_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tricks/new.html.twig', [
            'trick' => $trick,
            'form' => $form,
            'formMedia' => $formMedia,
        ]);
    }

    #[Route('/{name}', name: 'app_tricks_show', methods: ['GET', 'POST'])]
    public function show(Request $request, Tricks $trick, EntityManagerInterface $entityManager, TricksRepository $tricksRepository): Response
    {
        $form = $this->createForm(CommentType::class);
        $medias = $trick->getMedia();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setTricks($trick);
            $comment->setUser($this->getUser());
            $comment->setCreatedAt(new \DateTimeImmutable());
            $entityManager->persist($comment);
            $entityManager->flush();
            $this->addFlash('success', 'Votre commentaire a bien été ajouté');
        }
        return $this->render('tricks/show.html.twig', [
            'trick' => $trick,
            'medias' => $medias,
            'form'=> $form,
        ]);
    }

    #[Route('/{name}/edit', name: 'app_tricks_edit', methods: ['GET', 'POST'])]
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

    #[Route('/supprimer/{name}', name: 'app_tricks_delete', methods: ['POST'])]
    public function delete(Request $request, Tricks $trick, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trick->getId(), $request->request->get('_token'))) {
            $fileSysteme = new Filesystem();
            $fileSysteme->remove('../public/assets/images/triks/'.$trick->getName());
            $entityManager->remove($trick);

            $entityManager->flush();
        }

        return $this->redirectToRoute('app_default', [], Response::HTTP_SEE_OTHER);
    }
}
