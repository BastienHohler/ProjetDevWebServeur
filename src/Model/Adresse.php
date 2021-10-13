<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Option
 * @ORM\Entity @ORM\Table(name="adresses")
 */
class Adresse
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="adresse")
     * @var User[] An ArrayCollection of Bug objects.
     */
     private $listeUser;

    /**
     * @ORM\Column(name="rue", type="string")
     */
    private $rue;

    /**
     * @ORM\Column(name="ville", type="string")
     */
    private $ville;

    /**
     * @ORM\Column(name="cp", type="string")
     */
    private $cp;


    public function getIdAdresse() {
        return $this->id;
    }
    public function setIdAdresse( $id ) {
        $this->id = $id;
    }

    public function getRue() {
        return $this->rue;
    }
    public function setRue( $rue ) {
        $this->rue = $rue;
    }

    public function getVille() {
        return $this->ville;
    }
    public function setVille( $ville ) {
        $this->ville = $ville;
    }

    public function getCp() {
        return $this->cp;
    }
    public function setCp( $cp ) {
        $this->cp = $cp;
    }

    public function __construct()
    {
        $this->listeUser = new ArrayCollection();
    }

    public function addUser(User $user)
    {
        $this->listeUser[] = $user;
    }

    public function getUser()
    {
        return $this->listeUser;
    }
    
}
