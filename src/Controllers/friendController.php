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

    function listFriends($id){
        $user = $this->em->find('User', $id);
        $listFriends = $this->em->getRepository(Friend::class)->findBy(array('user' => $user));
        $list = array();
        foreach($listFriends as $value){
            $friend = $value->getFriend();
            if($this->em->getRepository(Friend::class)->findBy(['user' => $friend, 'friend' => $value->getUser()])){
                array_push($list,["prenom" => $friend->getPrenom(), "nom" => $friend->getNom(), "id_friend" => $value->getIdFriend()]);
            }
        }
        return $list;
    }

    function pendingList($id){
        $user = $this->em->find('User', $id);
        $list = array();
        $listPending = $this->em->getRepository(Friend::class)->findBy(array('user' => $user));
        foreach($listPending as $value){
            $friend = $value->getFriend();
            if(!($this->em->getRepository(Friend::class)->findBy(['user' => $friend, 'friend' => $value->getUser()]))){
                array_push($list,["prenom" => $friend->getPrenom(), "nom" => $friend->getNom(), "id_friend" => $value->getIdFriend()]);
            }
        }
        return $list;
    }

    function requestList($id){
        $user = $this->em->find('User', $id);
        $listFriends = $this->em->getRepository(Friend::class)->findBy(array('user' => 63));
        $list = array();
        foreach($listFriends as $value){
            $user = $value->getFriend();
            if($this->em->getRepository(Friend::class)->findBy(['user' => $user, 'friend' => $value->getUser()])){
                array_push($list,["prenom" => $user->getPrenom(), "nom" => $user->getNom(), "id_friend" => $user->getId()]);
            }
        }
        return $list;
    }

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

}
