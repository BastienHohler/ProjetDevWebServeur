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

class GroupController
{
  /**
   * @var EntityManager
   */
  private $em;

  public function createGroup($parsedBody)
  {
    $group = new Group();
    $group->setName($parsedBody['nameGroup']);
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

    $this->em->remove($group);
    $this->em->flush();
  }

  function addUserGroup($id_group, $id_user)
  {
    $group = $this->em->find('Group', $id_group);
    $group->addUser($this->em->find('User', $id_user));
    $this->em->persist($group);
    $this->em->flush();
  }

  function getAll() {
    return $this->em->getRepository(Group::class)->findAll();
  }

  public function __construct(EntityManager $em)
  {
    $this->em = $em;
  }

  public function getAvailableGroups($id)
  {
    $groups = $this->getAll();
    $availableGrps = [];
    $user = $this->em->find('User',$id);
    foreach ($groups as $grp) {
      if (!in_array($user,$grp->getUsers()))
      {
        $availableGrps[] = $grp;
      }
    }
    return $availableGrps;
  }

  public function getUsers($id_group) {

  }
}
