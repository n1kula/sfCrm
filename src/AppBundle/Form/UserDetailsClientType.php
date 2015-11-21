<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Validator\Constraints\Pesel;

class UserDetailsClientType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', 'text', [
                'label' => 'client.firstName',
            ])
            ->add('lastName', 'text', [
                'label' => 'Nazwisko',
            ])
            ->add('pesel', 'text', [
                'label' => 'Nr PESEL',
                'constraints' => [
                    new Pesel(),
                ]
            ])
        ;        
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\UserDetailsClient',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'client';
    }
}
