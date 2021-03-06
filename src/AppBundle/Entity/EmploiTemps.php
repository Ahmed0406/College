<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmploiTemps
 *
 * @ORM\Table(name="emploi_temps")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmploiTempsRepository")
 */
class EmploiTemps
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Files", cascade={"remove","persist"})
     */
    private $file;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Bulletin" , cascade={"remove"})
     */
    private $bulletin;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set file
     *
     * @param \AppBundle\Entity\Files $file
     *
     * @return EmploiTemps
     */
    public function setFile(Files $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return \AppBundle\Entity\Files
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return EmploiTemps
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set bulletin
     *
     * @param \AppBundle\Entity\Bulletin $bulletin
     *
     * @return EmploiTemps
     */
    public function setBulletin(\AppBundle\Entity\Bulletin $bulletin = null)
    {
        $this->bulletin = $bulletin;

        return $this;
    }

    /**
     * Get bulletin
     *
     * @return \AppBundle\Entity\Bulletin
     */
    public function getBulletin()
    {
        return $this->bulletin;
    }
}
