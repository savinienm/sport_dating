<?php

namespace App\Form;

use App\Entity\Sport;
use App\Form\SportType;
use App\Form\SportsmanType;
use App\Form\QuerySportsmanType;
use App\Entity\SportPracticeBySportsman;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class QueryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('SportData', SportType::class, ['label' => false])
                ->add(
                    'Niveau',
                    ChoiceType::class,
                    [
                            'choices' => [
                                'Débutant'  => 'Débutant',
                                'Confirmé'  => 'Confirmé',
                                'Pro'       => 'Pro',
                                'Supporter' => 'Supporter'
                            ],
                        ]
                )
                ->add('SportsmanData', QuerySportsmanType::class, ['label' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SportPracticeBySportsman::class,
        ]);
    }
}
