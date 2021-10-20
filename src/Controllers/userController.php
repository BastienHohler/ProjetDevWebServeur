<?php

declare(strict_types=1);

//namespace UMA\DoctrineDemo\Action;

use Doctrine\ORM\EntityManager;
use Nyholm\Psr7;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

require_once __DIR__ . '/../Model/User.php';


class userController implements RequestHandlerInterface

{
    /**
     * @var EntityManager
     */
    private $em;

    public function createUser($name,$login,$password) {
        $user = new User();
        $user->setNom($name);
        $user->setLogin($login);
        $user->setPassword($password);
        $this->em->persist($user);
        $this->em->flush();
        return "Bienvenue, ".$name.". Votre ID est : ".$user->getId().".";
    }

    function deleteUser($id)
    {
    $user = $this->em->find('App\Model\User', $id);

    $this->em->remove($user);
    $this->em->flush();
}

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

}
