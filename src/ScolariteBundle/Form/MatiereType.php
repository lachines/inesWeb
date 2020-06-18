<?php

namespace ScolariteBundle\Form;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatiereType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomMatiere', null ,['attr' => ['class' => 'form-control']] )
                ->add('coefMatiere', null ,['attr' => ['class' => 'form-control']])
                ->add('nbreHeureMatiere', null ,['attr' => ['class' => 'form-control']])
                ->add('enseignant', null ,['attr' => ['class' => 'form-control']])
                ->add('Ajouter', SubmitType::class  ,['attr' => ['class' => 'btn btn-primary']]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ScolariteBundle\Entity\Matiere'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'scolaritebundle_matiere';
    }


}
