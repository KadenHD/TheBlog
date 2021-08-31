<?php

namespace App\Form;

use App\Entity\Questionnaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionnaireFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('langue', ChoiceType::class, [
                'choices' => [
                    'Anglais' => 'Anglais',
                    'Allemand' => 'Allemand',
                    'Espagnol' => 'Espagnol',
                ],
            ])
            ->add('niveau', ChoiceType::class, [
                'choices' => [
                    'A1' => 'A1',
                    'A2' => 'A2',
                    'B1' => 'B1',
                    'B2' => 'B2',
                    'C1' => 'C1',
                    'C2' => 'C2',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Questionnaire::class,
        ]);
    }
}
