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
        $qb = $this->createQueryBuilder('agent');
        
        if (!$user->hasRole('ROLE_ADMIN')) {
            $qb
                ->where('agent.manager = :manager')
                ->setParameter('manager', $user);
        }
        
        return $qb->getQuery()->getResult();
    }
}
