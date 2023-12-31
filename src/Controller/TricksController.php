<?php

namespace App\Controller;

use App\Entity\Media;
use App\Entity\Tricks;
use App\Form\CommentType;
use App\Form\EditTricksType;
use App\Form\MediaType;
use App\Form\TricksType;
use App\Repository\CommentRepository;
use App\Repository\TricksRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
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
            $cheminDossier = '/assets/images/triks/' . $trick->getName();

            //création du dossier
            if (!is_dir('../public' . $cheminDossier)) {
                mkdir('../public' . $cheminDossier, 0777);
                mkdir('../public' . $cheminDossier . '/media');
            }

            $filePicture = $form->get('pictureStorage')->getData();
            //ajout de l'image principale si elle existe sinon ajout d'une image par défaut
            if ($filePicture) {
                $trick->setPictureStorage($cheminDossier . '/cover.' . $filePicture->guessExtension());
                $filePicture->move('../public' . $cheminDossier, '/cover.' . $filePicture->guessExtension());

            } else {
                copy('../public/assets/images/cover.jpg', '../public' . $cheminDossier . '/cover.jpg');
                $trick->setPictureStorage($cheminDossier . '/cover.jpg');
            }

            if ($trick->getMedia()) {
                $i = 0;
                foreach ($trick->getMedia() as $media) {

                    $media->setTricks($trick);
                    $media->setCreatedAt(new \DateTimeImmutable());
                    $media->setUser($this->getUser());

                    if ($media->IsVideo()) {
                        $iframe = $media->getVideo();
                        $regex = '/https[^"]+/';
                        preg_match($regex, $iframe, $matches);
                        $media->setVideo($matches[0]);
                        $media->setPicture(null);
                    } else {
                        $file = $request->files->get('tricks')['media'][$i]['picture'];
                        $media->setPicture($cheminDossier . '/media/' . $media->getName() . '.' . $file->guessExtension());
                        $file->move('../public' . $cheminDossier . '/media/', $media->getName() . '.' . $file->guessExtension());
                        $media->setIsVideo(false);
                    }
                    $i++;
                    $entityManager->persist($media);
                }
            }
            $trick->setSlug($trick->getName());
            $entityManager->persist($trick);
            $entityManager->flush();
            $this->addFlash('success', 'Votre tricks a bien été ajouté');

            return $this->redirectToRoute('app_default', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tricks/new.html.twig', [
            'trick' => $trick,
            'form' => $form,
            'formMedia' => $formMedia,
        ]);
    }

    #[Route('/{slug}', name: 'app_tricks_show', methods: ['GET', 'POST'])]
    public function show(Request $request, Tricks $trick, EntityManagerInterface $entityManager): Response
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
            'form' => $form,
        ]);
    }

    #[Route('/{slug}/edit', name: 'app_tricks_edit', methods: ['GET', 'POST'])]
    public function edit(Tricks $trick, Request $request, EntityManagerInterface $entityManager): Response
    {

        $form = $this->createForm(EditTricksType::class, $trick,);
        $formMedia = $this->createForm(MediaType::class, null, ['csrf_field_name' => '_token_media']);
        $form->handleRequest($request);
        $formMedia->handleRequest($request);
        $cheminDossier = '/assets/images/triks/' . $trick->getName();

        if ($formMedia->isSubmitted() && $formMedia->isValid()) {
            $media = new Media();
            $media = $formMedia->getData();
            $media->setTricks($trick);
            $media->setCreatedAt(new \DateTimeImmutable());
            $media->setUser($this->getUser());
            if (!is_dir('../public' . $cheminDossier)) {
                mkdir('../public' . $cheminDossier, 0777);
                mkdir('../public' . $cheminDossier . '/media');
            }
            if ($media->IsVideo()) {
                $iframe = $media->getVideo();
                $regex = '/https[^"]+/';
                preg_match($regex, $iframe, $matches);
                $media->setVideo($matches[0]);
                $media->setPicture(null);
            } else {
                $file = $request->files->get('media')['picture'];
                $media->setPicture($cheminDossier . '/media/' . $media->getName() . '.' . $file->guessExtension());
                $file->move('../public' . $cheminDossier . '/media/', $media->getName() . '.' . $file->guessExtension());
                $media->setIsVideo(false);
            }

            $entityManager->persist($media);
            $entityManager->flush();
            $this->addFlash('success', 'Votre media a bien été ajouté');
            return $this->redirectToRoute('app_tricks_edit', ['name' => $trick->getName()], Response::HTTP_SEE_OTHER);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $trick->setUpdatedAt(new \DateTimeImmutable());

            if (!is_dir('../public' . $cheminDossier)) {
                mkdir('../public' . $cheminDossier, 0777);
                mkdir('../public' . $cheminDossier . '/media');
            }

            $filePicture = $form->get('pictureStorage')->getData();
            if ($filePicture) {
                $trick->setPictureStorage($cheminDossier . '/cover.' . $filePicture->guessExtension());
                $filePicture->move('../public' . $cheminDossier, '/cover.' . $filePicture->guessExtension());
            }
            $trick->setSlug($trick->getName());
            $trick->setUser($this->getUser());
            $entityManager->flush();
            $this->addFlash('success', 'Le tricks a bien été modifié');
            return $this->redirectToRoute('app_default', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tricks/edit.html.twig', [
            'trick' => $trick,
            'form' => $form,
            'formMedia' => $formMedia,
        ]);
    }

    #[Route('/supprimer/{slug}', name: 'app_tricks_delete', methods: ['POST'])]
    public function delete(Request $request, Tricks $trick, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $trick->getId(), $request->request->get('_token'))) {
            $fileSysteme = new Filesystem();
            $fileSysteme->remove('../public/assets/images/triks/' . $trick->getName());
            $entityManager->remove($trick);

            $entityManager->flush();
            $this->addFlash('success', 'Le tricks a bien été supprimé');
        }

        return $this->redirectToRoute('app_default', [], Response::HTTP_SEE_OTHER);
    }
}
