<?php

declare(strict_types=1);

//namespace UMA\DoctrineDemo\Action;

use Doctrine\ORM\EntityManager;
use Nyholm\Psr7;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

require_once __DIR__ . '/../Model/Group.php';
require_once __DIR__ . '/../Model/Board.php';

class BoardController
{
    /**
     * @var EntityManager
     */
    private $em;

    public function createGroup($parsedBody) {
      $board = new Board();
      $board->setContends($parsedBody['contendsBoard']);
      $board->setGroup(find('Group', $parsedBody['id_group']));
      $this->em->persist($board);
      $this->em->flush();
    }

    function deleteBoard($id)
    {
      $board = $this->em->find('Board', $id);

      $this->em->remove($board);
      $this->em->flush();
    }

    function modifBoard($id_board, $contends)
    {
      $board = $this->em->find('Board', $id_board);
      $board->setContends($contends);
      $this->em->persist($board);
      $this->em->flush();
    }

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

}
