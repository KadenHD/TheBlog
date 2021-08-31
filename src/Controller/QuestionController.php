<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Questionnaire;
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
}
