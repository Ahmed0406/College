<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Bibliotheque
 *
 * @ORM\Table(name="bibliotheque")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BibliothequeRepository")
 */
class Bibliotheque
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
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Livre", mappedBy="bibliotheque")
     * @ORM\OrderBy({"id" = "ASC"})
     */
    private $livre;


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
     * @return Bibliotheque
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->livre = new ArrayCollection();
    }

    /**
     * Add livre
     *
     * @param \AppBundle\Entity\Livre $livre
     *
     * @return Bibliotheque
     */
    public function addLivre(\AppBundle\Entity\Livre $livre)
    {
        $this->livre[] = $livre;

        return $this;
    }

    /**
     * Remove livre
     *
     * @param \AppBundle\Entity\Livre $livre
     */
    public function removeLivre(\AppBundle\Entity\Livre $livre)
    {
        $this->livre->removeElement($livre);
    }

    /**
     * Get livre
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLivre()
    {
        return $this->livre;
    }
}
