<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"user" = "User", "eleve" = "Eleve", "enseignant" = "Enseignant"})
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_niss;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cin;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $address;

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set dateNiss
     *
     * @param \DateTime $dateNiss
     *
     * @return User
     */
    public function setDateNiss($dateNiss)
    {
        $this->date_niss = $dateNiss;

        return $this;
    }

    /**
     * Get dateNiss
     *
     * @return \DateTime
     */
    public function getDateNiss()
    {
        return $this->date_niss;
    }

    /**
     * Set cin
     *
     * @param integer $cin
     *
     * @return User
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return integer
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }
}
