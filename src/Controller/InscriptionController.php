<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription_index")
     */
    public function index(): Response
    {
        return $this->render('inscription/index.html.twig', []);
    }

    /**
     * @Route("/questionnaire", name="questionnaire_choose")
     */
    public function choose(): Response
    {
        return $this->render('questionnaire/choose.html.twig', []);
    }
}
