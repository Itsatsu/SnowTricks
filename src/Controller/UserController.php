<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserEditType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/utilisateur')]
class UserController extends AbstractController
{
    #[Route('/{username}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{username}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser() !== $user) {
            $this->addFlash('error', "Vous ne pouvez pas modifier le compte d'un autre utilisateur.");
            return $this->redirectToRoute('app_default', [], Response::HTTP_SEE_OTHER);
        }

        $form = $this->createForm(UserEditType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cheminDossier = '/assets/images/user/'.$user->getId();
            if (!is_dir('../public'.$cheminDossier)) {
                mkdir('../public'.$cheminDossier,0777);
            }
            if($form->get('photoPath')->getData() !== null) {
                $file = $form->get('photoPath')->getData();
                $user->setPhotoPath($cheminDossier.'/avatar.'.$file->guessExtension());
                $file->move('../public'.$cheminDossier.'/','avatar.'.$file->guessExtension());
            }
            $entityManager->flush();
            $this->addFlash('success', "Votre compte a bien été modifié.");
            return $this->redirectToRoute('app_user_show', ['username' => $user->getUsername()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
