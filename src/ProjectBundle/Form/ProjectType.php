<?php

namespace ProjectBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('projectName')->add('projectCategory',ChoiceType::class,array(
            'choices'=>[
            'Customer Service'=>'Customer Service',
            'Data Analytics'=>'Data Analytics',
            'Design'=>'Design',
            'IT & Networking'=>'IT & Networking',
            'Sales & Marketing'=>'Sales & Marketing'
            ]))->add('projectLocation')->add('minBudget')->add('maxBudget')->add('projectSkill')->add('projectDescription');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProjectBundle\Entity\Project'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'projectbundle_project';
    }


}
