<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\MessageBundle\Model\ParticipantInterface;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"user" = "User", "eleve" = "Eleve", "enseignant" = "Enseignant"})
 */
class User extends BaseUser implements ParticipantInterface
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Article", mappedBy="user", cascade={"remove"})
     */
    private $article;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Commentaire", mappedBy="user", cascade={"remove"})
     */
    private $commentaire;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Message", mappedBy="sender", cascade={"remove"})
     */
    private $message;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MessageMetadata", mappedBy="participant", cascade={"remove"})
     */
    private $messagedata;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Thread", mappedBy="createdBy", cascade={"remove"})
     */
    private $thread;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ThreadMetadata", mappedBy="participant", cascade={"remove"})
     */
    private $threaddata;

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
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

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
     * Get dateNiss
     *
     * @return \DateTime
     */
    public function getDateNiss()
    {
        return $this->date_niss;
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
     * Get cin
     *
     * @return integer
     */
    public function getCin()
    {
        return $this->cin;
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
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
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
     * @return mixed
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param mixed $article
     */
    public function setArticle($article)
    {
        $this->article = $article;
    }

    /**
     * @return mixed
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * @param mixed $commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getMessagedata()
    {
        return $this->messagedata;
    }

    /**
     * @param mixed $messagedata
     */
    public function setMessagedata($messagedata)
    {
        $this->messagedata = $messagedata;
    }

    /**
     * @return mixed
     */
    public function getThread()
    {
        return $this->thread;
    }

    /**
     * @param mixed $thread
     */
    public function setThread($thread)
    {
        $this->thread = $thread;
    }

    /**
     * @return mixed
     */
    public function getThreaddata()
    {
        return $this->threaddata;
    }

    /**
     * @param mixed $threaddata
     */
    public function setThreaddata($threaddata)
    {
        $this->threaddata = $threaddata;
    }

    /**
     * Add article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return User
     */
    public function addArticle(\AppBundle\Entity\Article $article)
    {
        $this->article[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \AppBundle\Entity\Article $article
     */
    public function removeArticle(\AppBundle\Entity\Article $article)
    {
        $this->article->removeElement($article);
    }

    /**
     * Add commentaire
     *
     * @param \AppBundle\Entity\Commentaire $commentaire
     *
     * @return User
     */
    public function addCommentaire(\AppBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaire[] = $commentaire;

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \AppBundle\Entity\Commentaire $commentaire
     */
    public function removeCommentaire(\AppBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaire->removeElement($commentaire);
    }

    /**
     * Add message
     *
     * @param \AppBundle\Entity\Message $message
     *
     * @return User
     */
    public function addMessage(\AppBundle\Entity\Message $message)
    {
        $this->message[] = $message;

        return $this;
    }

    /**
     * Remove message
     *
     * @param \AppBundle\Entity\Message $message
     */
    public function removeMessage(\AppBundle\Entity\Message $message)
    {
        $this->message->removeElement($message);
    }

    /**
     * Add messagedatum
     *
     * @param \AppBundle\Entity\MessageMetadata $messagedatum
     *
     * @return User
     */
    public function addMessagedatum(\AppBundle\Entity\MessageMetadata $messagedatum)
    {
        $this->messagedata[] = $messagedatum;

        return $this;
    }

    /**
     * Remove messagedatum
     *
     * @param \AppBundle\Entity\MessageMetadata $messagedatum
     */
    public function removeMessagedatum(\AppBundle\Entity\MessageMetadata $messagedatum)
    {
        $this->messagedata->removeElement($messagedatum);
    }

    /**
     * Add thread
     *
     * @param \AppBundle\Entity\Thread $thread
     *
     * @return User
     */
    public function addThread(\AppBundle\Entity\Thread $thread)
    {
        $this->thread[] = $thread;

        return $this;
    }

    /**
     * Remove thread
     *
     * @param \AppBundle\Entity\Thread $thread
     */
    public function removeThread(\AppBundle\Entity\Thread $thread)
    {
        $this->thread->removeElement($thread);
    }

    /**
     * Add threaddatum
     *
     * @param \AppBundle\Entity\ThreadMetadata $threaddatum
     *
     * @return User
     */
    public function addThreaddatum(\AppBundle\Entity\ThreadMetadata $threaddatum)
    {
        $this->threaddata[] = $threaddatum;

        return $this;
    }

    /**
     * Remove threaddatum
     *
     * @param \AppBundle\Entity\ThreadMetadata $threaddatum
     */
    public function removeThreaddatum(\AppBundle\Entity\ThreadMetadata $threaddatum)
    {
        $this->threaddata->removeElement($threaddatum);
    }
}
