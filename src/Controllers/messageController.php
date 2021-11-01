<?php

declare(strict_types=1);

//namespace UMA\DoctrineDemo\Action;

use Doctrine\ORM\EntityManager;
use Nyholm\Psr7;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

require_once __DIR__ . '/../Model/Message.php';
require_once __DIR__ . '/../Model/File.php';
require_once __DIR__ . '/../Model/User.php';

class MessageController
{
  /**
   * @var EntityManager
   */
  private $em;

  public function createMessage($parsedBody)
  {
    session_start();
    $_SESSION["messageError"] = "";
    $_SESSION["messageSuccess"] = "";
    $message = new Message();
    $sender = $this->em->find('User', $_SESSION['userId']);

    if (isset($parsedBody['recipient']) && $parsedBody['recipient'] != null) {
      $recipient = $this->em->find('User', $parsedBody['recipient']);
      $message->setSender($sender);
      $message->setRecipient($recipient);
      $message->setContents($parsedBody['content']);
      $_SESSION["header"] = "Location:http://localhost:8080/messagerie/msg/".$parsedBody['recipient'];
      $this->em->persist($message);
      $this->em->flush();
    } else if (isset($parsedBody['group'])) {
      $grp = $this->em->find('Group', $parsedBody['group']);
      $message->setSender($sender);
      $message->setContents($parsedBody['content']);
      $message->setGroup($grp);
      $_SESSION["header"] = "Location:http://localhost:8080/messagerie/msggroup/".$parsedBody['group'];
      $this->em->persist($message);
      $this->em->flush();
    } else {
      $_SESSION["messageError"] = "Veuillez choisir un utilisateur.";
      $_SESSION["header"] = "Location:http://localhost:8080/messagerie/new";
    }

    if (isset($parsedBody['titleFile'])) {
      $file = new File();
      $file->setTitle($parsedBody['titleFile']);
      $file->setDate($parsedBody['dateFile']);
      $file->setExtension($parsedBody['extensionFile']);
      $file->setMetadata($parsedBody['metadataFile']);
      $file->setMessage($message);
      $this->em->persist($file);
      $this->em->flush();
    }
  }

  function getChat($user_id,$friend_id) {
    return $this->em->getRepository(Message::class)->findBy(['recipient'=>[$user_id,$friend_id],'sender'=>[$user_id,$friend_id]],['id'=>'ASC']);
  }

  function deleteMessage($id)
  {
    session_start();
    $message = $this->em->find('Message', $id);
    if ($message->getGroup() != null) {
      if ($_SESSION["userId"] == $message->getSender()->getId()) {
        $this->em->remove($message);
        $this->em->flush();
      }
      
      $_SESSION["header"] = "Location:http://localhost:8080/messagerie/msggroup/".$message->getGroup()->getIdGroup();
    } else {
      if ($_SESSION["userId"] == $message->getSender()->getId()) {
        $this->em->remove($message);
        $this->em->flush();
        $_SESSION["header"] = "Location:http://localhost:8080/messagerie/msg/".$message->getRecipient()->getId();
      }
      
    }
  }

  function getAll()
  {
    $messages = $this->em->getRepository(Message::class)->findBy(['recipient' => $_SESSION["userId"]]);
    return $messages;
  }

  function getAllGroup($id_group)
  {
    return $this->em->getRepository(Message::class)->findBy(['group' => $id_group]);
  }

  public function __construct(EntityManager $em)
  {
    $this->em = $em;
  }
}
