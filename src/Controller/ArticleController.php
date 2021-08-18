<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Commentaire;
use App\Form\ArticleFormType;
use App\Form\CommentaireFormType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article_index")
     */
    public function index(ArticleRepository $repository)
    {
        $articles = $repository->findAll();
        return $this->render('article/index.html.twig', [
            "articles" => $articles
        ]);
    }

    /**
     * @Route("/article/create", name="article_create")
     * @Route("/article/edit/{id}", name="article_edit")
     */
    public function formArticle(Article $article = null, Request $request, EntityManagerInterface $emi)
    {   
        if(!$article) {
            $article = new Article();
        }

        // Gestion de Redirections
        $user = $this->getUser();
        if ($user != $article->getAuteur() && $article->getId() !== null) {
            return $this->redirectToRoute('user_index', ['alert' => "articleNotYour"]);
        }

        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            if(!$article->getId()) {
                $alert = 'articleCreated';
                $article->setDate(new \DateTime());
                $article->setAuteur($user);
            } else {
                $alert = 'articleEdited';
                $article->setDateModif(new \DateTime());
            }

            $emi->persist($article);
            $emi->flush();
            return $this->redirectToRoute('article_show', [
                'id' => $article->getId(),
                'alert' => $alert
            ]);
        }

        return $this->render('article/form.html.twig', [
            "formArticle" => $form->createView(),
            "editMode" => $article->getId() !== null
        ]);
    }

    /**
     * @Route("/article/show/{id}", name="article_show")
     */
    public function showArticle_formComment(Article $article,Commentaire $commentaire = null, Request $request, EntityManagerInterface $emi)
    {   
        $commentaire = new Commentaire();

        $form = $this->createForm(CommentaireFormType::class, $commentaire);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            if(!$commentaire->getId()) {
                $alert = 'commentCreated';
                $commentaire->setDate(new \DateTime());
                $user = $this->getUser();
                $commentaire->setAuteur($user);
                $commentaire->setArticle($article);
            }

            $emi->persist($commentaire);
            $emi->flush();

            return $this->redirectToRoute('article_show', [
                'id' => $article->getId(),
                'alert' => $alert
            ]);
        }

        return $this->render('article/show.html.twig', [
            "formCommentaire" => $form->createView(),
            "commentaire" => $commentaire,
            "article" => $article
        ]);
    }

    /**
     * @Route("/article/delete/{id}", name="article_delete", methods={"GET", "DELETE"})
     */
    public function deleteArticle(Article $article)
    {
        $user = $this->getUser();
        $author = $article->getAuteur();
        if ($user != $author) {
            return $this->redirectToRoute('user_index', ['alert' => "articleNotYour"]);
        }else {
            $emi=$this->getDoctrine()->getManager();
            $emi->remove($article);
            $emi->flush();
        }
        
        return $this->redirectToRoute('user_index', ['alert' => "articleDeleted"]);
    }
}