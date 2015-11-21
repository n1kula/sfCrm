<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class AgreementLifeType extends AbstractType
{
    /**
     * @var User
     */
    private $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('value', null, [
                'label' => 'Wartość umowy',
            ])
            ->add('person', null, [
                'label' => 'Osoba do ubezpieczenia',
            ])
            
            ->add('client', 'entity', [
                'label' => 'Klient',
                'class' => 'AppBundle\Entity\UserDetailsClient',
                'property' => 'fullName',
                'query_builder' => function(EntityRepository $er) {
                    return $er
                        ->createQueryBuilder('c');
                },
            ])
            
            ->add('attachments', 'collection', [
                'label' => 'Załącznik',
                'type' => new AttachmentType(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'error_bubbling' => false,
            ])
        ;
        
        if ($this->user->hasRole('ROLE_MANAGER')) {
            $builder
                ->add('agent', 'entity', [
                    'label' => 'Agent',
                    'class' => 'AppBundle\Entity\UserDetailsAgent',
                    'property' => 'fullName',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->getAgentsQueryBuilder($this->user);
                    },
                ]);
        }
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\AgreementLife',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'agreementlife';
    }
}
