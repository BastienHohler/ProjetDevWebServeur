<?php

declare(strict_types=1);

//namespace UMA\DoctrineDemo\Action;

use Doctrine\ORM\EntityManager;
use Nyholm\Psr7;

require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../Model/Adresse.php';
require_once __DIR__ . '/../Model/Group.php';


class UserController
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function createUser($parsedBody)
    {
        session_start();
        if ($parsedBody['nom'] != "" && $parsedBody['prenom'] != "" && $parsedBody['login'] != "" && $parsedBody['password'] != "" && $parsedBody['mail'] != "" && $parsedBody['rue'] != "" && $parsedBody['ville'] != "" && $parsedBody['cp'] != "" && $parsedBody['pays'] != "") {
            if ($this->em->getRepository(User::class)->findOneBy(['login' => $parsedBody['login']]) != null) {
                $_SESSION["messageError"] = "Ce login est déjà utilisé.";
                $_SESSION["header"] = "Location:http://localhost:8080/signUp";
            }
            else if ($this->em->getRepository(User::class)->findOneBy(['mail' => $parsedBody['mail']]) != null) {
                $_SESSION["messageError"] = "Ce mail est déjà utilisé.";
                $_SESSION["header"] = "Location:http://localhost:8080/signUp";
            }
            else {
                $user = new User();
                $user->setNom($parsedBody['nom']);
                $user->setPrenom($parsedBody['prenom']);
                $user->setLogin($parsedBody['login']);
                $user->setPassword(password_hash($parsedBody['password'], PASSWORD_DEFAULT));
                $user->setMail($parsedBody['mail']);
                if (isset($parsedBody['etat'])) {
                    $user->setEtat("covided");
                } else $user->setEtat("safe");
                if (isset($parsedBody['anonyme'])) {
                    $user->setAnonyme(true);
                } else $user->setAnonyme(false);

                $adresse = new Adresse();
                $adresse->setRue($parsedBody['rue']);
                $adresse->setVille($parsedBody['ville']);
                $adresse->setCp($parsedBody['cp']);
                if (!intval($parsedBody['cp'])) {
                    $_SESSION["messageError"] = "Veuillez mettre un code postal correct !";
                    $_SESSION["header"] = "Location:http://localhost:8080/signUp";
                } else {
                    $adresse->setPays($parsedBody['pays']);
                    $this->em->persist($adresse);

                    $user->setAdresse($adresse);
                    $this->em->persist($user);
                    $this->em->flush();
                    $_SESSION["userName"] = $user->getPrenom() . " " . $user->getNom();
                    $_SESSION["userId"] = $user->getId();
                    $_SESSION["header"] = "Location:http://localhost:8080/";
                }
            }
        } else {
            $_SESSION["messageError"] = "Veuillez remplir tous les champs !";
            $_SESSION["header"] = "Location:http://localhost:8080/signUp";
        }
    }

public function login($parsedBody)
{
    session_start();
    if ($parsedBody['login'] != "" && $parsedBody['password'] != "") {
        $user = $this->em->getRepository(User::class)->findOneBy(['login' => $parsedBody['login']]);
        if ($user == null) {
            $_SESSION["messageErrorSignin"] = "Cet utilisateur est introuvable.";
            $_SESSION["header"] = "Location:http://localhost:8080/signIn";
        }
        else if (!password_verify($parsedBody['password'], $user->getPassword())) {
            $_SESSION["messageErrorSignin"] = "Mot de passe incorrect.";
            $_SESSION["header"] = "Location:http://localhost:8080/signIn";
        }
        else {
            $_SESSION["userName"] = $user->getPrenom() . " " . $user->getNom();
            $_SESSION["userId"] = $user->getId();
            $_SESSION["header"] = "Location:http://localhost:8080/";
        }
    } else {
        $_SESSION["messageErrorSignin"] = "Veuillez remplir tous les champs !";
        $_SESSION["header"] = "Location:http://localhost:8080/signIn";
    }
}

    public function deleteUser($id)
    {
        $user = $this->em->find('User', $id);

        $this->em->remove($user);
        $this->em->flush();
        session_start();
        session_unset();
        $_SESSION["header"] = "Location:http://localhost:8080/";
    }

    function signOut(){
      session_start();
      session_unset();
      $_SESSION["header"] = "Location:http://localhost:8080/";
    }

    public function getGroups($id) {
        return $this->em->find('User',$id)->getGroups();
    }

}
