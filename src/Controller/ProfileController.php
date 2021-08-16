<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProfileController extends AbstractController
{

    /**
     * @Route("/profile", name="profile")
     */
    public function profile() {
        $user = $this->getUser();

        if ($user == null) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('profile/profile.html.twig', [
            "user" => $user,
        ]);
        
    }

    /**
     * @Route("/profile/{id}", name="delete_article", methods={"GET", "DELETE"})
     */
    public function delete(Article $article)
    {
        $user = $this->getUser();

        if ($user == null) {
            return $this->redirectToRoute('app_login');
        }

        $author = $article->getAuteur();

        if ($user == $author) {
            $emi=$this->getDoctrine()->getManager();
            $emi->remove($article);
            $emi->flush();
        }
        
        return $this->redirectToRoute('profile');
    }

    /**
     * @Route("/modify", name="modify_profile")
     */
    public function update(Request $request, EntityManagerInterface $emi)
    {
        $user = $this->getUser();

        if ($user == null) {
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createFormBuilder($user)
            ->add("username", TextType::class, [
                "attr" => [
                    'value' => $user->getUsername(),
                ]
            ])
            ->add("email", TextType::class, [
                "attr" => [
                    'value' => $user->getEmail(),
                ]
            ])
            ->add("description", CKEditorType::class, [
                "attr" => [
                    'value' => $user->getDescription(),
                ],
                'required' => true,
                'constraints'=>[
                    new NotBlank(),
                ]
            ])
            ->add("submit", SubmitType::class, [
                "attr" => [
                    "onclick" => "return confirm('Do you really want to modify your infos ?')",
                    "class" => "btn btn-primary",
                    "style" => "margin-top: 0.5%;%"
                ]
            ])

            ->getForm();
            
        $user->setDateModif(new \DateTime());

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $emi->persist($user);
            $emi->flush();
            return $this->redirectToRoute('profile');
        }

        return $this->render('profile/modifyUser.html.twig', [
            "user" => $user,
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/articles", name="create_article")
     */
    public function create(Request $request, EntityManagerInterface $emi)
    {   
        $user = $this->getUser();

        if ($user == null) {
            return $this->redirectToRoute('app_login');
        }

        $article = new Article();

        $form = $this->createFormBuilder($article)
            ->add("titre", TextType::class)
            ->add("image", UrlType::class)
            ->add("contenu", CKEditorType::class, [
                'required' => true,
                'constraints'=>[
                    new NotBlank(),
                ]
            ])
            ->add("submit", SubmitType::class, [
                "attr" => [
                    "onclick" => "return confirm('Do you really want to create this article ?')",
                    "class" => "btn btn-primary",
                    "style" => "margin-top: 0.5%;%"
                ]
            ])

            ->getForm();

        $user = $this->getUser();

        $article->setAuteur($user);
        $article->setDate(new \DateTime());
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $emi->persist($article);
            $emi->flush();
            return $this->redirectToRoute('profile');
        }

        return $this->render('profile/createArticle.html.twig', [
            "article" => $article,
            "form" => $form->createView()
        ]);
    }
}
