<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/user/user/create", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {   
        if (($this->getUser()->getRoles() != ["ROLE_SUPER_ADMIN"])
        && ($this->getUser()->getRoles() != ["ROLE_ADMIN"]))
        {
            return $this->redirectToRoute('user_index', ['alert' => "userCantCreate"]);
        }
    
            $user = new User();
            $form = $this->createForm(RegistrationFormType::class, $user);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                $user->setDescription('');
                $user->setEmail($form->get('email')->getData());
                // encode the plain password
                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    ),
                    $user->setDateCreation(new \DateTime())
                );
                $user->setRoles(['ROLE_USER']);
    
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
                // do anything else you need here, like send an email
                    
                return $this->redirectToRoute('user_index', ['alert' => "userCreated"]);
            }
    
            return $this->render('registration/register.html.twig', [
                'registrationForm' => $form->createView(),
            ]);
    }
}
