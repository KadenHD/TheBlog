<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user_index")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('user/index.html.twig', [
            "user" => $user,
        ]);
    }

    /**
     * @Route("/user/edit/{id}", name="user_edit")
     */
    public function edit(User $user,Request $request, EntityManagerInterface $emi)
    {
        if ($user != $this->getUser()) {
            return $this->redirectToRoute('user_index', ['alert' => "userNotYour"]);
        }

        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $user->setDateModif(new \DateTime());
            $emi->persist($user);
            $emi->flush();
            return $this->redirectToRoute('user_index', ['alert' => "userEdited"]);
        }

        return $this->render('user/edit.html.twig', [
            "user" => $user,
            "formUser" => $form->createView()
        ]);
    }
}