<?php 

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class UserDetailsAgent
 * @ORM\Entity
 */
class UserDetailsAgent extends UserDetails
{
    /**
     * @var decimal
     *
     * @ORM\Column(name="commission", type="decimal", scale=2, precision=10)
     */
    private $commission;
    
    /**
     * Set commission
     *
     * @param decimal $commission
     *
     * @return UserDetailsAgent
     */
    public function setCommission($commission)
    {
        $this->commission = $commission;

        return $this;
    }

    /**
     * Get commission
     *
     * @return decimal
     */
    public function getCommission()
    {
        return $this->commission;
    }
}
