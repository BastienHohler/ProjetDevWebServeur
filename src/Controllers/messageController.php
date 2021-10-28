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

    public function createMessage($parsedBody) {
        session_start();
        $_SESSION["messageError"]="";
        $_SESSION["messageSuccess"]="";
        $message = new Message();
        $sender = $this->em->find('User', $_SESSION['userId']);
        $recipient =$this->em->getRepository(User::class)->findOneBy(['login'=>$parsedBody['recipient']]);
        if ($recipient==null) {
          $_SESSION["messageError"] = "Utilisateur introuvable.";
          $_SESSION["header"] = "Location:http://localhost:8080/messagerie/new";
        }
        else {
          $message->setSender($sender);

          if(isset($parsedBody['recipient'])){
            $message->setRecipient($recipient);
          }else $message->setGroup($parsedBody['id_group']);

          $message->setContents($parsedBody['content']);
          $this->em->persist($message);
          $this->em->flush();

          if(isset($parsedBody['titleFile'])){
            $file = new File();
            $file->setTitle($parsedBody['titleFile']);
            $file->setDate($parsedBody['dateFile']);
            $file->setExtension($parsedBody['extensionFile']);
            $file->setMetadata($parsedBody['metadataFile']);
            $file->setMessage($message);
            $this->em->persist($file);
            $this->em->flush();
          }
          $_SESSION["messageSuccess"] = "Message envoyé !";
          $_SESSION["header"] = "Location:http://localhost:8080/messagerie/new";
        }

    }

    function deleteMessage($id)
    {
      $message = $this->em->find('Message', $id);

      $this->em->remove($message);
      $this->em->flush();
    }

    function getAll() {
        session_start();
        $messages = $this->em->getRepository(Message::class)->findBy(['recipient' => $_SESSION["userId"]]);
        return $messages;
      }

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

}
