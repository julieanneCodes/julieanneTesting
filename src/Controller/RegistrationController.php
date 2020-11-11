<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserType;
use App\Entity\User;
use App\Repository\ViewConfigRepository;
use App\Security\LoginFormAuthAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="user_register")
     */
    public function register(LoginFormAuthAuthenticator $authenticator, GuardAuthenticatorHandler $guard, Request $request, UserPasswordEncoderInterface $passwordEncoder, ViewConfigRepository $configRepo)
    {
        $defaultView = $configRepo->findOneBy(['id' => 1]);
        $email = isset($_SESSION["email"]) ? $_SESSION["email"] : "";
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $password= $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $user->setViewConfig($defaultView);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $guard->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main'
            );
            return $this->redirectToRoute('calendar_index');
        }
        return $this->render('registration/new.html.twig', 
            array('form' => $form->createView())
        );
    }
}
