<?php

namespace ScolariteBundle\Form;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GroupeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomGroupe', null ,['attr' => ['class' => 'form-control']])
                ->add('nbrEnfantGroupe', null ,['attr' => ['class' => 'form-control']])
                ->add('enseignantGroupe', null ,['attr' => ['class' => 'form-control']])
                ->add('ageGroupe', null ,['attr' => ['class' => 'form-control']])
                ->add('Ajouter', SubmitType::class,['attr' => ['class' => 'btn btn-primary']] )
            ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ScolariteBundle\Entity\Groupe'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'scolaritebundle_groupe';
    }


}
