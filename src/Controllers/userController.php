<?php

declare(strict_types=1);

//namespace UMA\DoctrineDemo\Action;

use Doctrine\ORM\EntityManager;
use Nyholm\Psr7;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../Model/Adresse.php';

class UserController
{
    /**
     * @var EntityManager
     */
    private $em;

    public function createUser($parsedBody) {
        $user = new User();
        $user->setNom($parsedBody['nom']);
        $user->setPrenom($parsedBody['prenom']);
        $user->setLogin($parsedBody['login']);
        $user->setPassword(password_hash($parsedBody['password'], PASSWORD_DEFAULT));
        $user->setMail($parsedBody['mail']);
        if(isset($parsedBody['etat'])){
          $user->setEtat("covided");
        }else $user->setEtat("safe");
        if(isset($parsedBody['anonyme'])){
          $user->setAnonyme(true);
        }else $user->setAnonyme(false);

        $adresse = new Adresse();
        $adresse->setRue($parsedBody['rue']);
        $adresse->setVille($parsedBody['ville']);
        $adresse->setCp($parsedBody['cp']);
        $adresse->setPays($parsedBody['pays']);
        $this->em->persist($adresse);

        $user->setAdresse($adresse);
        $this->em->persist($user);
        $this->em->flush();
        session_start();
        $_SESSION["userName"] =$user->getPrenom()." ".$user->getNom();
    }

    function deleteUser($id)
    {
    $user = $this->em->find('User', $id);

    $this->em->remove($user);
    $this->em->flush();
}

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

}
