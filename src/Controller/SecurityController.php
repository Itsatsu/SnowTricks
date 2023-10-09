<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Services\MailService;
use Doctrine\ORM\EntityManagerInterface;
use http\Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/connexion', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // redirect already logged in users to user page
         if ($this->getUser()) {
             $this->addFlash('success', 'Vous êtes déjà connecté');
             return $this->redirectToRoute('app_default');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig',
            ['last_username' => $lastUsername,
                'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route('/inscription', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,MailService $mail): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $token = random_bytes(24);
            $user->setToken(bin2hex($token));
            $user->setRoles(['ROLE_USER']);
            $filePath = realpath(__DIR__ . '/../../public/assets/images/logo.png');
            $user->setPhotoPath('/assets/images/avatar.jpg');
            $user->setPhotoName('Avatar par défaut');
            $mail->to($user->getEmail());
            $mail->subject("SnowTricks - Activation de votre compte");
            $mail->setTemplate("mail/Activation.html.twig", [
                'user' => $user,
            ]);

            if(!$mail->send()){
                $this->addFlash('error', "Une erreur est survenue lors de l'envoi de l'email.Réessayer plus tard");
                return $this->redirectToRoute('app_user_new', [
                ], Response::HTTP_SEE_OTHER);
            }

            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Votre compte a bien été créé. Un email vous a été envoyé pour activer votre compte.');
            return $this->redirectToRoute('app_login', [
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/inscription/{token}', name: 'app_activation')]
public function activation(UserRepository $userRepository, string $token, EntityManagerInterface $entityManager): Response
    {
        $user =$userRepository->findOneBy(['token' => $token]);
        if(!$user || $user->getToken() === null){
            $this->addFlash('error', 'Token inconnu ou votre compte est déjà activé.');
            return $this->redirectToRoute('app_login', [
            ], Response::HTTP_SEE_OTHER);
        }
        $user->setToken(null);
        $entityManager->persist($user);
        $entityManager->flush();
        $this->addFlash('success', 'Votre compte a bien été activé.');
        return $this->redirectToRoute('app_login', [
        ], Response::HTTP_SEE_OTHER);
    }

    #[Route('/mail', name: 'app_mail')]
    public function mail(UserRepository $userRepository)
    {
        $user = $userRepository->findOneBy(['id' => 1]);
        return $this->render('mail/Activation.html.twig', [
            'user' => $user,
        ]);
    }
}
