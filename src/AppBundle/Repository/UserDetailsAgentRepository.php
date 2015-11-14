<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\User;

/**
 * Class UserDetailsAgentRepository
 */
class UserDetailsAgentRepository extends EntityRepository
{
    public function getAgents(User $user)
    {
        $qb = $this->createQueryBuilder();
        
        $qb
            ->select('a')
            ->form('AppBundle:UserDetailsAgent', 'a');
        
        if (!$user->hasRole('ROLE_ADMIN')) {
            $qb
                ->where('a.manager = :manager')
                ->setParameter('manager', $user);
        }
        
        return $qb->getQuery()->getResult();
    }
}
