<?php

declare(strict_types=1);

//namespace UMA\DoctrineDemo\Action;

use Doctrine\ORM\EntityManager;
use Nyholm\Psr7;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../Model/Group.php';
require_once __DIR__ . '/../Model/Board.php';
require_once __DIR__ . '/../Model/GroupParticipant.php';

class GroupController
{
  /**
   * @var EntityManager
   */
  private $em;

  public function createGroup($parsedBody, $id_user)
  {
    $group = new Group();
    $group->setName($parsedBody['grp_name']);
    $gp = new GroupParticipant();
    $gp->setUser($this->em->find('User', $id_user));
    $gp->setGroup($group);
    $this->em->persist($gp);
    $this->em->persist($group);
    $this->em->flush();

    if (isset($parsedBody['contendsBoard'])) {
      $board = new Board();
      $board->setContends($parsedBody['contendsBoard']);
      $board->setGroup($group);
      $this->em->persist($board);
      $this->em->flush();
    }
  }

  function deleteGroup($id)
  {
    $group = $this->em->find('Group', $id);
    $gps = $this->em->getRepository(GroupParticipant::class)->findBy(['group' => $id]);
    foreach ($gps as $gp) {
      $this->em->remove($gp);
    }
    $this->em->remove($group);
    $this->em->flush();
  }

  function addUserGroup($id_group, $id_user)
  {
    $group = $this->em->find('Group', $id_group);
    $user = $this->em->find('User', $id_user);
    $gp = new GroupParticipant();
    $gp->setUser($user);
    $gp->setGroup($group);
    $this->em->persist($gp);
    $this->em->flush();
  }

  function removeUserGroup($id_group, $id_user) {
    $group = $this->em->find('Group', $id_group);
    $user = $this->em->find('User', $id_user);
    $gp = $this->em->getRepository(GroupParticipant::class)->findOneBy(['group' => $group,'user'=>$user]);
    $this->em->remove($gp);
    $this->em->flush();
  }

  function findById($id) {
    return $this->em->find('Group',$id);
  }
  function getAll()
  {
    return $this->em->getRepository(Group::class)->findAll();
  }

  public function __construct(EntityManager $em)
  {
    $this->em = $em;
  }

  public function getAvailableGroups($id)
  {
    $groups = $this->getAll();
    $availableGrps = array();
    $userGrp = $this->em->find('User', $id)->getGroups();
    foreach ($groups as $grp) {
      if (!in_array($grp, $userGrp)) {
        $availableGrps[] = $grp;
      }
    }
    return $availableGrps;
  }

  public function getUsers($id_group)
  {
    return $this->em->getRepository(GroupParticipant::class)->findBy(['group' => $id_group]);
  }
}
