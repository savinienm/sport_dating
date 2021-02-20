<?php

namespace App\Form;

use App\Entity\Sportsman;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SportsmanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', 'http://geo.api.gouv.fr/departements')->toArray();
        (array) $departement = [];
        foreach ($response as $dep) {
            array_push($departement, $dep['code'] . " " . $dep['nom']);
        }
        (array) $depart = array_flip($departement);
        foreach ($departement as $dep){
            $depart[$dep]=$dep;
        }
        $builder
            ->add('Nom')
            ->add('Prenom')
            ->add(
                'Departement',
                ChoiceType::class,
                [
                        'choices' => $depart
                    ]
            )
            ->add('Email')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sportsman::class,
        ]);
    }
}
