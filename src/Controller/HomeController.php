<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Commentaire;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\NotBlank;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function home(ArticleRepository $repository)
    {   
        $articles = $repository->findAll();

        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            "articles" => $articles
        ]);
    }
    /**
     * @Route("/show/article/{id}", name="show_article")
     */
    public function show(Article $article, Request $request, EntityManagerInterface $emi)
    {   
        $commentaire = new Commentaire();

        $form = $this->createFormBuilder($commentaire)
            ->add("contenu", CKEditorType::class, [
                'required' => true,
                'constraints'=>[
                    new NotBlank(),
                ]
            ])
            ->add("submit", SubmitType::class, [
                "attr" => [
                    "onclick" => "return confirm('Do you really want to post this comment ?')",
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

            // Redirect to last url
            return $this->redirect($request->server->get('HTTP_REFERER'));
        }

        return $this->render('home/article.html.twig', [
            "article" => $article,
            "form" => $form->createView()
        ]);
    }


}
