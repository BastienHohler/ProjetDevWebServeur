<?php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

require_once __DIR__ . '/../Model/Board.php';

/**
 * Option
 * @ORM\Entity @ORM\Table(name="groups")
 */
class Group
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
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Board")
     * @var Board An Board of Board objects.
     * @ORM\JoinColumn(onDelete="CASCADE") 
     */
    private $board;

    /**
     * @ORM\OneToMany(targetEntity=GroupParticipant::class, mappedBy="group")
     * @ORM\JoinColumn(onDelete="CASCADE") 
     */
    private $groupParticipants;


    public function getIdGroup()
    {
        return $this->id;
    }
    public function setIdGroup($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getBoard()
    {
        return $this->board;
    }
    public function setBoard(Board $board)
    {
        $this->board = $board;
    }

    public function __construct()
    {
        $this->groupParticipants = array();
    }

    public function getUsers()
    {
        $users = array();
        foreach ($this->groupParticipants as $gp) {
            $users[] = $gp->getUser();
        }
        return $users;
    }
}
