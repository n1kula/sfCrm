<?php 

namespace AppBundle\Security;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class ApiKeyUserProvider
 */
class ApiKeyUserProvider implements UserProviderInterface
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    public function getUsernameForApiKey($apiKey)
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('u')
            ->from('AppBundle:User', 'u')
            ->where('u.apiKey = :apiKey')
            ->setParameter('apiKey', $apiKey);

        $user = $qb->getQuery()->getOneOrNullResult();

        if ($user) {
            return $user->getUsername();
        }
    }
    
    public function getUserForApiKey($apiKey)
    {
        $username = $this->getUsernameForApiKey($apiKey);
        if ($username) {
            return $this->loadUserByUsername($username);
        }
    }
    
    public function loadUserByUsername($username)
    {
        $qb = $this->em->createQueryBuilder();

        $qb
            ->select('u')
            ->from('AppBundle:User', 'u')
            ->where('u.username = :username')
            ->setParameter('username', $username);
        
        return $qb->getQuery()->getOneOrNullResult();
    }
    
    public function refreshUser(UserInterface $user)
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('u')
            ->from('AppBundle:User', 'u')
            ->where('u.id = ?', $user->getId());
        $refreshedUser = $qb->getQuery()->getOneOrNullResult();

        if (null === $refreshedUser) {
            throw new UsernameNotFoundException(sprintf('User with ID "%d" could not be reloaded.', $user->getId()));
        }

        return $refreshedUser;
    }
    
    public function supportsClass($class)
    {
        return $class === $this->getClass();
    }
}
