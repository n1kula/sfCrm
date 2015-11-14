<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var UserDetails
     * 
     * @ORM\OneToOne(targetEntity="UserDetails")
     */
    protected $details;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set details
     *
     * @param \AppBundle\Entity\UserDetails $details
     *
     * @return User
     */
    public function setDetails(\AppBundle\Entity\UserDetails $details = null)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Get details
     *
     * @return \AppBundle\Entity\UserDetails
     */
    public function getDetails()
    {
        return $this->details;
    }
}
