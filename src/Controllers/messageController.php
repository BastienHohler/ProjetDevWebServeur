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
        $message = new Message();
        $message->setSender(find('User',$parsedBody['id_send']));

        if(isset($parsedBody['id_recip'])){
          $message->setRecipient(find('User',$parsedBody['id_recip']));
        }else $message->setGroup($parsedBody['id_group']);

        $message->setContends($parsedBody['contends']);
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

    }

    function deleteMessage($id)
    {
      $message = $this->em->find('Message', $id);

      $this->em->remove($message);
      $this->em->flush();
    }

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

}
