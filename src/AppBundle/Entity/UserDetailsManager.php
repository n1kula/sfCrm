<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserDetailsManager
 * @ORM\Entity
 */
class UserDetailsManager extends UserDetails
{
    /**
     * @var decimal
     *
     * @ORM\Column(name="salary", type="decimal", scale=2, precision=10)
     */
    private $salary;

    /**
     * @var integer
     *
     * @ORM\Column(name="area", type="smallint")
     */
    private $area;
    
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="UserDetailsAgent", mappedBy="manager")
     */
    private $agents;


    /**
     * Set salary
     *
     * @param string $salary
     *
     * @return UserDetailsManager
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * Get salary
     *
     * @return string
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * Set area
     *
     * @param integer $area
     *
     * @return UserDetailsManager
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return integer
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->agents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add agent
     *
     * @param \AppBundle\Entity\UserDetailsAgent $agent
     *
     * @return UserDetailsManager
     */
    public function addAgent(\AppBundle\Entity\UserDetailsAgent $agent)
    {
        $this->agents[] = $agent;

        return $this;
    }

    /**
     * Remove agent
     *
     * @param \AppBundle\Entity\UserDetailsAgent $agent
     */
    public function removeAgent(\AppBundle\Entity\UserDetailsAgent $agent)
    {
        $this->agents->removeElement($agent);
    }

    /**
     * Get agents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAgents()
    {
        return $this->agents;
    }
}
