<?php

declare(strict_types=1);

//namespace UMA\DoctrineDemo\Action;

use Doctrine\ORM\EntityManager;
use Nyholm\Psr7;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../Model/friend.php';

class FriendController
{
    /**
     * @var EntityManager
     */
    private $em;

    public function createFriend($parsedBody) {
        $friend = new Friend();
        $friend->setUser(find('User',$parsedBody['id_user']));
        $friend->setFriend(find('User',$parsedBody['id_friend']));
        $this->em->persist($friend);
        $this->em->flush();
    }

    function deleteFriend($id)
    {
      $friend = $this->em->find('Friend', $id);

      $this->em->remove($friend);
      $this->em->flush();
    }

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

}
