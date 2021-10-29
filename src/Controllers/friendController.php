<?php

declare(strict_types=1);

//namespace UMA\DoctrineDemo\Action;

use Doctrine\ORM\EntityManager;
use Nyholm\Psr7;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../Model/Friend.php';

class FriendController
{
    /**
     * @var EntityManager
     */
    private $em;

    public function createFriend($parsedBody) {
        $friend = new Friend();
        session_start();
        $friend->setUser($this->em->find('User',$_SESSION["userId"]));
        $friend->setFriend($this->em->find('User',$parsedBody['id_friend']));
        $this->em->persist($friend);
        $this->em->flush();
        $_SESSION["header"] = "Location:http://localhost:8080/friend";
    }

    function deleteFriend($id)
    {
        session_start();
      $friend = $this->em->find('Friend', $id);
        if($_SESSION["userId"] == $friend->getUser()->getId()){
            $this->em->remove($friend);
            $this->em->flush();
            if($user = $this->em->getRepository(Friend::class)->findOneBy(['user' => $friend->getFriend(), 'friend' => $friend->getUser()])){
                $this->em->remove($user);
                $this->em->flush();
            }
        }
        $_SESSION["header"] = "Location:http://localhost:8080/friend";
    }

    function listFriends($id){
        $user = $this->em->find('User', $id);
        $listFriends = $this->em->getRepository(Friend::class)->findBy(array('user' => $user));
        $list = array();
        foreach($listFriends as $value){
            $friend = $value->getFriend();
            if($this->em->getRepository(Friend::class)->findOneBy(['user' => $friend, 'friend' => $value->getUser()])){
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
            if(!($this->em->getRepository(Friend::class)->findOneBy(['user' => $friend, 'friend' => $value->getUser()]))){
                array_push($list,["prenom" => $friend->getPrenom(), "nom" => $friend->getNom(), "id_friend" => $value->getIdFriend()]);
            }
        }
        return $list;
    }

    function requestList($id){
        $user = $this->em->find('User', $id);
        $listRequest = $this->em->getRepository(Friend::class)->findBy(array('friend' => $id));
        $list = array();
        foreach($listRequest as $value){
            $applicant = $value->getUser();
            if(!($this->em->getRepository(Friend::class)->findOneBy(['user' => $id, 'friend' => $applicant]))){
                array_push($list,["prenom" => $applicant->getPrenom(), "nom" => $applicant->getNom(), "id_friend" => $applicant->getId(), "id" => $value->getIdFriend()]);
            }
        }
        return $list;
    }

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

}
