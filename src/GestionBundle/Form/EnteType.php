<?php

namespace GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('apellido')->add('nombre')->add('documento')->add('telefono')->add('email')->add('direccion');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'inherit_data' => true,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gestionbundle_ente';
    }


}
