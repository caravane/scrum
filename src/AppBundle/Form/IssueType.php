<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use AppBundle\ENtity\IssueStatus;

class IssueType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('summary','text',array(
                'required'=>true
            ))
            ->add('priority','entity',array(
                'class'=>'AppBundle:Priority',
                'data'=>'major',
                'required'=>true
            ))
            ->add('dueDate')
            ->add('component')
            ->add('environment')
            ->add('description')
            ->add('original_estimate')
            ->add('remaining_estimate')
            ->add('labels')
            ->add('project','entity',array(
                'class'=>'AppBundle:Project',
                'required'=>true
            ))
            ->add('status','entity', array(
                'class'=>'AppBundle:IssueStatus',
                'data'=>'To do'
                )
            )
            ->add('type','entity',array(
                'class'=>'AppBundle:IssueType',
                'required'=>true
            ))
            ->add('version','entity',array(
                'class'=>'AppBundle:Version',
                'multiple'=>true,
                'required'=>false
            ))
            ->add('fixVersion','entity',array(
                'class'=>'AppBundle:Version',
                'multiple'=>true,
                'required'=>false
            ))
            ->add('assignee')
            ->add('reporter','entity',array(
                'class'=>'AppBundle:User',
                'required'=>true
            ))
            ->add('epic')
            ->add('sprint')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Issue'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_issue';
    }
}
