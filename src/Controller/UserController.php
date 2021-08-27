<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use App\Repository\UserRepository;
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
        //Edit permissions
        //Let only admin and super edit profiles
        if (($user != $this->getUser()) 
            && (($this->getUser()->getRoles() != ["ROLE_SUPER_ADMIN"])
            && ($this->getUser()->getRoles() != ["ROLE_ADMIN"]))
        ){
            return $this->redirectToRoute('user_index', ['alert' => "userNotYour"]);
        }
        //Let only super edit super
        if (($user->getRoles() == ["ROLE_SUPER_ADMIN"]) && ($user != $this->getUser())
        && (($this->getUser()->getRoles() != ["ROLE_SUPER_ADMIN"]))
        ){
        return $this->redirectToRoute('user_index', ['alert' => "userNoPermissions"]);
        }
        //Dont let admin edit admin
        if (($user->getRoles() == ["ROLE_ADMIN"]) && ($user != $this->getUser())
        && (($this->getUser()->getRoles() != ["ROLE_SUPER_ADMIN"]))
        ){
        return $this->redirectToRoute('user_index', ['alert' => "userNoPermissions"]);
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

    /**
     * @Route("/user/users", name="users_show")
     */
    public function showUsers(UserRepository $repository)
    {
        if (($this->getUser()->getRoles() != ["ROLE_SUPER_ADMIN"])
        && ($this->getUser()->getRoles() != ["ROLE_ADMIN"]))
        {
            return $this->redirectToRoute('user_index', ['alert' => "noAccess"]);
        }
        $users = $repository->findAll();
        return $this->render('user/users.html.twig', [
            "users" => $users
        ]);
    }
}
