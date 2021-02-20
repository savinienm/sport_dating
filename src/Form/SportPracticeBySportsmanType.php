<?php

namespace App\Form;

use App\Entity\SportPracticeBySportsman;
use Symfony\Component\Form\AbstractType;
use App\Form\SportType;
use App\Form\SportsmanType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SportPracticeBySportsmanType extends AbstractType
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
                ->add('SportsmanData', SportsmanType::class, ['label' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SportPracticeBySportsman::class,
        ]);
    }
}
