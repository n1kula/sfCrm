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

}
