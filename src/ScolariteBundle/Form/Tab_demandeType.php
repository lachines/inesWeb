<?php

namespace ScolariteBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class Tab_demandeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomDemande',null,['required'=>'true' ,'attr' => ['class'=> 'form-control'] ])
                ->add('prenomDemande',null,['required'=>'true', 'attr' => ['class'=> 'form-control'] ])
                ->add('cinDemande',null,['required'=>'true', 'attr' => ['class'=> 'form-control'] ])
                ->add('numTelDemande',null,['required'=>'true', 'attr' => ['class'=> 'form-control'] ])
                ->add('cVDemande','Symfony\Component\Form\Extension\Core\Type\FileType',['required'=>'true', 'attr' => ['class'=> 'form-control'] ])
                ->add('dateNaissance',null,['required'=>'true', 'attr' => ['class'=> 'date-picker form-control'] ])
                ->add('etudeDemande',null,['required'=>'true', 'attr' => ['class'=> 'form-control'] ])
                ->add('posteDemande',null,['required'=>'true', 'attr' => ['class'=> 'form-control'] ])
                
                ->add('Ajouter', SubmitType::class,['attr' => ['class'=> 'btn btn-primary btn-block'] ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ScolariteBundle\Entity\Tab_demande'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'scolaritebundle_tab_demande';
    }


}
