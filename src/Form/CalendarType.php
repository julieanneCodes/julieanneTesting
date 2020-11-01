<?php

namespace App\Form;

use App\Entity\Calendar;
use App\Form\DataTransformer\UserIdTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Form\Type\HiddenIdType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalendarType extends AbstractType
{
    
    private $transformer;

    public function __construct(UserIdTransformer $transformer)
    {
        $this->transformer= $transformer;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $currentDate = date('Y-m-d');
        $currentTime = date('H:i', strtotime('+1 Hour'));
        $builder
            ->add('event_name')
            ->add('time', TimeType::class, [
                'widget' => 'single_text',
                'attr' => [
                  'value' => $currentTime
                ]
            ])
            ->add('day', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'min' => $currentDate, 
                    'value' => $currentDate
                ],
            ])
            ->add('user', HiddenIdType::class)
            ->add('notes');
        $builder->get('user')->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}
