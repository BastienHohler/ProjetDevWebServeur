<?php

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToMany(targetEntity="User")
     * @var User[] An ArrayCollection of User objects.
     */
    private $listUsers;

    /**
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Board", inversedBy="group")
     * @var Board An Board of Board objects.
     */
    private $board;


    public function getIdGroup() {
        return $this->id;
    }
    public function setIdGroup( $id ) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }
    public function setName( $name ) {
        $this->name = $name;
    }

    public function getBoard() {
        return $this->board;
    }
    public function setBoard( Board $board ) {
        $this->board = $board;
    }

    public function __construct()
    {
        $this->listUsers = new ArrayCollection();
    }

    public function addUser(User $user)
    {
        $this->listUsers[] = $user;
    }

    public function getUser()
    {
        return $this->listUsers;
    }

}
