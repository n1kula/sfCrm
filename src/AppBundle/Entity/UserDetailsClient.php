<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserDetailsClient
 * @ORM\Entity
 */
class UserDetailsClient extends UserDetails
{
    /**
     * @var string
     *
     * @ORM\Column(name="pesel", type="string", length=11)
     */
    private $pesel;

    /**
     * Set pesel
     *
     * @param string $pesel
     *
     * @return UserDetailsClient
     */
    public function setPesel($pesel)
    {
        $this->pesel = $pesel;

        return $this;
    }

    /**
     * Get pesel
     *
     * @return string
     */
    public function getPesel()
    {
        return $this->pesel;
    }
}

