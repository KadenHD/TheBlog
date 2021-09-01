<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Questionnaire;
use App\Form\QuestionFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    /**
     * @Route("/user/question/create/{id}", name="question_create")
     */
    public function createQuestion(Questionnaire $questionnaire, Request $request, EntityManagerInterface $emi)
    {
        // Create the 10 questions of the questionnary
        $i = 1;
        while ($i <= 10) {
            $question = new Question();
            $question->setQuestionnaire($questionnaire);
            $question->setQ1('');
            $question->setQ2('');
            $question->setQ3('');
            $question->setQ4('');
            $question->setQuestion('');
            $question->setReponse('');
            $question->setNumero($i);

            $emi->persist($question);
            $emi->flush();
            $i = $i + 1;
        }
        return $this->redirectToRoute('questionnaire_show', [
            'id' => $questionnaire->getId(),
            'alert' => 'questionnaireCreated'
        ]);
    }

    /**
     * @Route("/user/question/edit/{id}", name="question_edit")
     */
    public function editQuestion(Question $question, Request $request, EntityManagerInterface $emi)
    {
        //Edit permissions
        //Let only admin and super edit profiles
        $user = $question->getQuestionnaire()->getAuteur();
        if (($user != $this->getUser())
            && (($this->getUser()->getRoles() != ["ROLE_SUPER_ADMIN"])
                && ($this->getUser()->getRoles() != ["ROLE_ADMIN"]))
        ) {
            return $this->redirectToRoute('user_index', ['alert' => "questionnaireNotYour"]);
        }
        //Let only super edit super
        if (($user->getRoles() == ["ROLE_SUPER_ADMIN"]) && ($user != $this->getUser())
            && (($this->getUser()->getRoles() != ["ROLE_SUPER_ADMIN"]))
        ) {
            return $this->redirectToRoute('user_index', ['alert' => "questionnaireNoPermissions"]);
        }
        //Dont let admin edit admin
        if (($user->getRoles() == ["ROLE_ADMIN"]) && ($user != $this->getUser())
            && (($this->getUser()->getRoles() != ["ROLE_SUPER_ADMIN"]))
        ) {
            return $this->redirectToRoute('user_index', ['alert' => "questionnaireNoPermissions"]);
        }

        $form = $this->createForm(QuestionFormType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $emi->persist($question);
            $emi->flush();
            return $this->redirectToRoute('questionnaire_show', [
                'id' => $question->getQuestionnaire()->getId(),
                'alert' => "questionEdited"
            ]);
        }

        return $this->render('question/edit.html.twig', [
            "question" => $question,
            "formQuestion" => $form->createView()
        ]);
    }
}
