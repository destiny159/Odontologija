<?php

namespace App\Form;

use App\Entity\Atsiliepimai;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class AtsiliepimaiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vardas')
            ->add('atsiliepimas')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Susipažinau ir sutinku su ',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Norėdami užsiregistruoti, turite sutikti su taisyklėmis.',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Atsiliepimai::class,
        ]);
    }
}
