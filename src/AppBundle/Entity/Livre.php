<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Livre
 *
 * @ORM\Table(name="livre")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LivreRepository")
 */
class Livre
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="ref", type="string", length=255, unique=true)
     */
    private $ref;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Bibliotheque", inversedBy="livre")
     */
    private $bibliotheque;


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
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Livre
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get ref
     *
     * @return string
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * Set ref
     *
     * @param string $ref
     *
     * @return Livre
     */
    public function setRef($ref)
    {
        $this->ref = $ref;

        return $this;
    }

    /**
     * Get bibliotheque
     *
     * @return \AppBundle\Entity\Bibliotheque
     */
    public function getBibliotheque()
    {
        return $this->bibliotheque;
    }

    /**
     * Set bibliotheque
     *
     * @param \AppBundle\Entity\Bibliotheque $bibliotheque
     *
     * @return Livre
     */
    public function setBibliotheque(Bibliotheque $bibliotheque = null)
    {
        $this->bibliotheque = $bibliotheque;

        return $this;
    }
}
