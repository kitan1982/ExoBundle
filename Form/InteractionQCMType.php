<?php

namespace UJM\ExoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Claroline\CoreBundle\Entity\User;

use UJM\ExoBundle\Repository\TypeQCMRepository;

class InteractionQCMType extends AbstractType
{
    private $user;
    private $catID;

    public function __construct(User $user, $catID = -1)
    {
        $this->user  = $user;
        $this->catID = $catID;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'interaction', new InteractionType(
                    $this->user, $this->catID
                )
            );
        $builder
            ->add(
                'shuffle', 'checkbox', array(
                    'label' => 'Inter_QCM.shuffle',
                    'required' => false
                )
            );
        $builder
            ->add(
                'scoreRightResponse', 'text', array(
                    'required' => false,
                    'label' => 'Inter_QCM.ScoreRightResponse',
                    'attr'  => array( 'placeholder' => 'Coords.score')
                )
            );
        $builder
            ->add(
                'scoreFalseResponse', 'text', array(
                    'required' => false,
                    'label' => 'Inter_QCM.ScoreFalseResponse',
                    'attr'  => array( 'placeholder' => 'Points','class'=>'col-md-2'),
                )
            );
        $builder
            ->add(
                'weightResponse', 'checkbox', array(
                    'required' => false,
                    'label' => 'Inter_QCM.weightChoice'
                )
            );
        $builder
            ->add(
                'typeQCM', 'entity', array(
                    'class' => 'UJM\\ExoBundle\\Entity\\TypeQCM',
                    'label' => 'TypeQCM.value',
                    'data_class' => 'UJM\\ExoBundle\\Entity\\TypeQCM',
                    'multiple' => false,
                    'expanded' => true,
                    'query_builder' => function(TypeQCMRepository $er) {
                        return $er->createQueryBuilder('TypeQCM')
                        ->orderBy('TypeQCM.value', 'DESC');
                    }
                )
            );
        $builder
            ->add(
                'choices', 'collection', array(
                    'type' => new ChoiceType,
                    'prototype' => true,
                    'allow_add' => true,
                    'allow_delete' => true
                )
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'UJM\ExoBundle\Entity\InteractionQCM',
                'cascade_validation' => true
            )
        );
    }

    public function getName()
    {
        return 'ujm_exobundle_interactionqcmtype';
    }
}