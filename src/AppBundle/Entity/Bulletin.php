<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bulletin
 *
 * @ORM\Table(name="bulletin")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BulletinRepository")
 */
class Bulletin
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
     * @return Bulletin
     */
    public function setFile(\AppBundle\Entity\Files $file = null)
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
     * @return Bulletin
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
}
