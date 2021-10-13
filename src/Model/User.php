<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Option
 * @ORM\Entity @ORM\Table(name="users")
 */
class User
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
     * @ORM\Column(name="nom", type="string")
     */
    protected $nom;

    /**
     * @ORM\Column(name="login", type="string")
     */
    protected $login;

    /**
     * @ORM\Column(name="password", type="string")
     */
    protected $password;


    public function getId() {
        return $this->id;
    }
    public function setId( $id ) {
        $this->id = $id;
    }

    public function getNom() {
        return $this->nom;
    }
    public function setNom( $nom ) {
        $this->nom = $nom;
    }

    public function getLogin() {
        return $this->login;
    }
    public function setLogin( $login ) {
        $this->login = $login;
    }

    public function getPassword() {
        return $this->password;
    }
    public function setPassword( $password ) {
        $this->password = $password;
    }

    /**
     * @ORM\ManyToMany(targetEntity="User")
     */
    private $listeAmis;

    public function __construct()
    {
        $this->listeAmis = new ArrayCollection();
    }

    public function addAmis(User $ami)
    {
        $this->listeAmis[] = $ami;
    }

    public function getAmis()
    {
        return $this->listeAmis;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Adresse")
     */
    private $adresse;

    public function setAdresse(Adresse $adresse)
    {
        $this->adresse = $adresse;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

}
