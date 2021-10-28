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
    private $id;

    /**
     * @ORM\Column(name="nom", type="string")
     */
    private $nom;

    /**
     * @ORM\Column(name="prenom", type="string")
     */
    private $prenom;

    /**
     * @ORM\Column(name="login", type="string")
     */
    private $login;

    /**
     * @ORM\Column(name="password", type="string")
     */
    private $password;

    /**
     * @ORM\Column(name="mail", type="string")
     */
    private $mail;

    /**
     * @ORM\Column(name="anonyme", type="boolean")
     */
    private $anonyme;

    /**
     * @ORM\Column(name="etat", type="string")
     */
    private $etat;



    public function getId() {
        return $this->id;
    }
    public function setId( $id ) {
        $this->id = $id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getFullName() {
        return $this->prenom . ' ' . $this->nom;
    }
    public function setNom( $nom ) {
        $this->nom = $nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom( $prenom ) {
        $this->prenom = $prenom;
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

    public function getMail() {
        return $this->password;
    }
    public function setMail( $mail ) {
        $this->mail = $mail;
    }

    public function getAnonyme() {
        return $this->anonyme;
    }
    public function setAnonyme( $anonyme ) {
        $this->anonyme = $anonyme;
    }

    public function getEtat() {
        return $this->etat;
    }
    public function setEtat( $etat ) {
        $this->etat = $etat;
    }

    public function setAdresse(Adresse $adresse)
    {
        $adresse->addUser($this);
        $this->adresse = $adresse;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

}
