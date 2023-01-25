<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{

   /* public function index(): Response
    {
        /*return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }*/

    public function inscription(Request $request, UserPasswordEncoderInterface   $passwordEncoder)
    {
        $em = $this->getDoctrine();
        $userRepository = $em->getRepository(User::class);
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encode the password
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            // Save the user
            $userRepository->add($user,true);
            return $this->redirectToRoute('inscription');
        }

        return $this->render('user/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
