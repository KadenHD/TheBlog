<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Commentaire;
use App\Entity\User;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(ArticleRepository $repository)
    {   
        $articles = $repository->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            "articles" => $articles
        ]);
    }

    #[Route('/articles/{id}', name: 'show_article')]
    public function show(Article $article, Request $request, EntityManagerInterface $emi)
    {   
        $commentaire = new Commentaire();

        $form = $this->createFormBuilder($commentaire)
            ->add("contenu", CKEditorType::class, [
            ])
            ->add("submit", SubmitType::class, [
                "attr" => [
                    "class" => "btn btn-primary",
                    "style" => "margin-top: 0.5%;%"
                ]
            ])

            ->getForm();

        $user = $this->getUser();

        $commentaire->setDate(new \DateTime());
        $commentaire->setArticle($article);
        $commentaire->setAuteur($user);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $emi->persist($commentaire);
            $emi->flush();
        }

        return $this->render('home/article.html.twig', [
            "article" => $article,
            "form" => $form->createView()
        ]);
    }

    #[Route('/profile', name: 'profile')]
    public function profile() {
        $user = $this->getUser();

        if ($user == null) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('user/profile.html.twig', [
            "user" => $user,
        ]);
        
    }

    #[Route("profile/{id}", name:"delete_article", methods:["GET", "DELETE"])]
    public function deleteArticle(Article $article)
    {
        $emi=$this->getDoctrine()->getManager();
        $emi->remove($article);
        $emi->flush();

        return $this->redirectToRoute('profile');
    }
    
}
