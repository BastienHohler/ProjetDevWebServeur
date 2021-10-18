<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Option
 * @ORM\Entity @ORM\Table(name="files")
 */
class File
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
     * @ORM\Column(name="title", type="string")
     */
    private $title;

    /**
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @ORM\Column(name="extension", type="string")
     */
    private $extension;

    /**
     * @ORM\Column(name="metadata", type="string")
     */
    private $metadata;


    public function getIdFile() {
        return $this->id;
    }
    public function setIdFile( $id ) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }
    public function setTitle( $title ) {
        $this->title = $title;
    }

    public function getDate() {
        return $this->date;
    }
    public function setDate( Date $date ) {
        $this->date = $date;
    }

    public function getExtension() {
        return $this->extension;
    }
    public function setExtension( $extension ) {
        $this->extension = $extension;
    }

    public function getMetadata() {
        return $this->metadata;
    }
    public function setMetadata( $metadata ) {
        $this->metadata = $metadata;
    }

    public function getMessage() {
        return $this->user;
    }
    
    public function setMessage( Message $message ) {
        $message->addFile($this);
        $this->message = $message;
    }

}
