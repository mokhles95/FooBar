<?php

namespace ReviewBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Entity\Employer;
use UserBundle\Entity\Freelancer;

class ReviewType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('projectId',EntityType::class, array(
            'class'=>'ProjectBundle:Project',
            'choice_label'=>'projectName',
            'multiple'=>false,
        ))
            ->add('freelancerReviewedId',EntityType::class, array(
                'class'=>'UserBundle:Freelancer',
                'choice_label'=>'firstName',
                'multiple'=>false,
            ))

            ->add('onBudget',ChoiceType::class,
                array('choices'=> array(
                    'Yes' => '1',
                    'No' => '0'),
                    'choices_as_values' => true,'multiple'=>false,'expanded'=>true))
            ->add('onTime',ChoiceType::class,
                array('choices'=> array(
                    'Yes' => '1',
                    'No' => '0'),
                    'choices_as_values' => true,'multiple'=>false,'expanded'=>true))
            ->add('rating',RangeType::class,[
                'attr' => [
                    'min' => 1,
                    'max' => 5
                ]
            ])
            ->add('comment', TextareaType::class);
         $builder->addEventListener(FormEvents::PRE_SET_DATA, function($e) {
                 if ( $e->getData() instanceof Employer) {
                     /* add fields specific to Type1 */
                 }
             })->addEventListener(FormEvents::PRE_SUBMIT, function($e) {
                 if ($e->getForm()->getData() instanceof Freelancer) {
                     /* add fields specific to Type1 */
                 }
             });

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ReviewBundle\Entity\Review'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'reviewbundle_review';
    }


}
