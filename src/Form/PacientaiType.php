<?php

namespace App\Form;

use App\Entity\Pacientai;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class PacientaiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gydymas', ChoiceType::class, array(
                'choices' => array(
                    'Terapinis (kariesų/ dantų ėduonis) gydymas' => 'Terapinis gydymas',
                    'Endodontinis (danties kanalų) gydymas' => 'Endodontinis gydymas',
                    'Ortopedinis (protezavimo) gydymas' => 'Ortopedinis gydymas',
                    'Chirurginis gydymas (pvz.: dantų šalinimas)' => 'Chirurginis gydymas',
                    'Periodontologinis gydymas (pvz.: kiuretažas, dantenų plastika)' => 'Periodontologinis gydymas',
                    'Profesionali burnos higiena' => 'Burnos higiena',
                    'Profilaktinė apžiūra' => 'Profilaktinė apžiūra',
                ),
                'expanded' => true,
                'multiple' => false,
                'label' => '1. Jeigu tiksliai žinote - pasirinkite Jums reikalingą gydymą. Jeigu abejojate, užpildykite nusiskundimų skiltį. Jeigu manote, kad jums reikalingi keli gydymai, kiekvienam formą užpildykite atskirai.',
            ))
            ->add('nusiskundimai')
            ->add('alergijos')
            ->add('bendrinesLigos')
            ->add('amzius', ChoiceType::class, array(
                'choices' => array(
                    '1-12 m.' => '1-12 m.',
                    '13-17 m.' => '13-17 m.',
                    '18-30 m.' => '18-30 m.',
                    '31-60 m.' => '31-60 m.',
                    '60 m. ir daugiau' => '60 m. ir daugiau',
                ),
                'expanded' => true,
                'multiple' => false,
                'label' => '5. Kuriai amžiaus grupei priklausote?',
            ))
            ->add('pirmadienis', ChoiceType::class, array(
                'choices' => array(
                    'Pirma dienos pusė' => 'Pirma dienos pusė',
                    'Antra dienos pusė' => 'Antra dienos pusė',
                ),
                'expanded' => true,
                'multiple' => true,
                'label' => 'Pirmadienis',
            ))
            ->add('antradienis', ChoiceType::class, array(
                'choices' => array(
                    'Pirma dienos pusė' => 'Pirma dienos pusė',
                    'Antra dienos pusė' => 'Antra dienos pusė',
                ),
                'expanded' => true,
                'multiple' => true,
                'label' => 'Antradienis',
            ))
            ->add('treciadienis', ChoiceType::class, array(
                'choices' => array(
                    'Pirma dienos pusė' => 'Pirma dienos pusė',
                    'Antra dienos pusė' => 'Antra dienos pusė',
                ),
                'expanded' => true,
                'multiple' => true,
                'label' => 'Trečiadienis',
            ))
            ->add('ketvirtadienis', ChoiceType::class, array(
                'choices' => array(
                    'Pirma dienos pusė' => 'Pirma dienos pusė',
                    'Antra dienos pusė' => 'Antra dienos pusė',
                ),
                'expanded' => true,
                'multiple' => true,
                'label' => 'Ketvirtadienis',
            ))
            ->add('penktadienis', ChoiceType::class, array(
                'choices' => array(
                    'Pirma dienos pusė' => 'Pirma dienos pusė',
                    'Antra dienos pusė' => 'Antra dienos pusė',
                ),
                'expanded' => true,
                'multiple' => true,
                'label' => 'Penktadienis',
            ))
            ->add('betKada', ChoiceType::class, array(
                'choices' => array(
                    'Pirma dienos pusė' => 'Pirma dienos pusė',
                    'Antra dienos pusė' => 'Antra dienos pusė',
                ),
                'expanded' => true,
                'multiple' => true,
                'label' => 'Tinka bet kurią dieną',
            ))
            ->add('vardas')
            ->add('numeris')
            ->add('kalbos', ChoiceType::class, array(
                'choices' => array(
                    'Lietuvių' => 'LT',
                    'Anglų' => 'EN',
                    'Rusų' => 'RU',
                ),
                'expanded' => true,
                'multiple' => true,
                'label' => '9. Kokiomis kalbomis kalbate?',
            ))
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
            'data_class' => Pacientai::class,
        ]);
    }
}
