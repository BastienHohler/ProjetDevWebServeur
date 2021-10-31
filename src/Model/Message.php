<?php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Option
 * @ORM\Entity @ORM\Table(name="messages")
 */
class Message
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @var User
     * @ORM\JoinColumn(onDelete="CASCADE") 
     */
     private $sender;

     /**
      * @ORM\ManyToOne(targetEntity="User")
      * @var User
      * @ORM\JoinColumn(onDelete="CASCADE") 
      */
      private $recipient;

      /**
       * @ORM\ManyToOne(targetEntity="Group")
       * @var Group
       * @ORM\JoinColumn(onDelete="CASCADE") 
       */
    private $group;

    /**
     * @ORM\Column(name="contents", type="string")
     */
    private $contents;

    /**
     * @ORM\ManyToMany(targetEntity="File")
     * @var File[] An ArrayCollection of File objects.
     */
     private $listFiles;


    public function setGroup($group) {
        $this->group = $group;
    }

    public function getGroup() {
        return $this->group;
    }

    public function getIdMessage() {
        return $this->id;
    }
    public function setIdMessage( $id ) {
        $this->id = $id;
    }

    public function getSender() {
        return $this->sender;
    }
    public function setSender(User $sender ) {
        $this->sender = $sender;
    }

    public function getRecipient() {
        return $this->recipient;
    }
    public function setRecipient(User $recipient ) {
        $this->recipient = $recipient;
    }

    public function getContents() {
        return $this->contents;
    }
    public function setContents( $contents ) {
        $this->contents = $contents;
    }

    public function __construct()
    {
        $this->listFiles = new ArrayCollection();
    }

    public function addFile(File $file)
    {
        $this->listFiles[] = $file;
    }

    public function getFiles()
    {
        return $this->listFiles;
    }


}
