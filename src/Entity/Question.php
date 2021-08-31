<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 */
class Question
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $q1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $q2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $q3;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $q4;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $question;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reponse;

    /**
     * @ORM\ManyToOne(targetEntity=Questionnaire::class, inversedBy="questions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $questionnaire;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQ1(): ?string
    {
        return $this->q1;
    }

    public function setQ1(string $q1): self
    {
        $this->q1 = $q1;

        return $this;
    }

    public function getQ2(): ?string
    {
        return $this->q2;
    }

    public function setQ2(string $q2): self
    {
        $this->q2 = $q2;

        return $this;
    }

    public function getQ3(): ?string
    {
        return $this->q3;
    }

    public function setQ3(string $q3): self
    {
        $this->q3 = $q3;

        return $this;
    }

    public function getQ4(): ?string
    {
        return $this->q4;
    }

    public function setQ4(string $q4): self
    {
        $this->q4 = $q4;

        return $this;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }

    public function getQuestionnaire(): ?Questionnaire
    {
        return $this->questionnaire;
    }

    public function setQuestionnaire(?Questionnaire $questionnaire): self
    {
        $this->questionnaire = $questionnaire;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }
}
