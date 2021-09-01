<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Questionnaire;
use App\Entity\User;
use App\Form\QuestionnaireFormType;
use App\Repository\QuestionnaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionnaireController extends AbstractController
{
    /**
     * @Route("/questionnaire", name="questionnaire")
     */
    public function index(): Response
    {
        return $this->render('questionnaire/index.html.twig', [
            'controller_name' => 'QuestionnaireController',
        ]);
    }

    /**
     * @Route("/user/questionnaire/create", name="questionnaire_create")
     */
    public function createQuestionnaire(Questionnaire $questionnaire = null, Question $question = null, Request $request, EntityManagerInterface $emi)
    {
        $questionnaire = new Questionnaire();

        $form = $this->createForm(QuestionnaireFormType::class, $questionnaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $questionnaire->setAuteur($user);
            $questionnaire->setDate(new \DateTime());

            $emi->persist($questionnaire);
            $emi->flush();

            return $this->redirectToRoute('question_create', [
                'id' => $questionnaire->getId(),
            ]);
        }

        return $this->render('questionnaire/create.html.twig', [
            "formQuestionnaire" => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/questionnaire/show/{id}", name="questionnaire_show")
     */
    public function showQuestionnaire(Questionnaire $questionnaire): Response
    {
        return $this->render('questionnaire/show.html.twig', [
            "questionnaire" => $questionnaire
        ]);
    }

    /**
     * @Route("/user/questionnaire/delete/{id}", name="questionnaire_delete", methods={"GET", "DELETE"})
     */
    public function deleteArticle(Questionnaire $questionnaire)
    {
        $user = $this->getUser();
        $author = $questionnaire->getAuteur();

        if (($user != $author)
            && (($user->getRoles() != ["ROLE_SUPER_ADMIN"])
                && ($user->getRoles() != ["ROLE_ADMIN"]))
        ) {
            return $this->redirectToRoute('user_index', ['alert' => "questionnaireNotYour"]);
        } else {
            $emi = $this->getDoctrine()->getManager();
            $emi->remove($questionnaire);
            $emi->flush();
        }

        $route = 'user_index';
        if ($author != $user) {
            $route = 'questionnaires_show';
        }
        return $this->redirectToRoute($route, ['alert' => "questionnaireDeleted"]);
    }

    /**
     * @Route("/user/questionnaires", name="questionnaires_show")
     */
    public function showUsers(QuestionnaireRepository $repository)
    {
        if (($this->getUser()->getRoles() != ["ROLE_SUPER_ADMIN"])
            && ($this->getUser()->getRoles() != ["ROLE_ADMIN"])
        ) {
            return $this->redirectToRoute('user_index', ['alert' => "noAccess"]);
        }

        $questionnaires = $repository->findAll();
        return $this->render('questionnaire/questionnaires.html.twig', [
            "questionnaires" => $questionnaires
        ]);
    }
}
