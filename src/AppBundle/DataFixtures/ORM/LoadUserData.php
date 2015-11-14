<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use AppBundle\Entity\UserDetailsAgent;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 1;
    }
    
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@crm.dev');
        $user->setPlainPassword('admin');
        $user->setEnabled(true);
        $user->addRole('ROLE_ADMIN');
        $this->addReference('admin', $user);
        
        $manager->persist($user);
        for ($j = 1; $j <= 10; $j++) {
            $user = new User();
            $user->setUsername('agent' . $j);
            $user->setEmail(sprintf('agent%d@crm.dev', $j));
            $user->setPlainPassword('demo');
            $user->setEnabled(true);
                        
            $details = new UserDetailsAgent();
            
            $details->setFirstName('Name ' . $j);
            $details->setLastName('Last name ' . $j);
            $details->setCommission(100);
            
            $manager->persist($details);
            
            $user->setDetails($details);
            $this->addReference('user_'.$j, $user);
            $manager->persist($user);
        }
        
        $manager->flush();
    }
}