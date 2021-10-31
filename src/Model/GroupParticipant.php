<?php

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="groupParticipants")
*/
class GroupParticipant
{
    /**
    * @ORM\Id
    * @ORM\GeneratedValue
    * @ORM\Column(type="integer")
    */
    protected $id;

    /**
    * @ORM\ManyToOne(targetEntity=User::class, inversedBy="groupParticipants")
    * @ORM\JoinColumn(onDelete="CASCADE") 
    */
    protected $user;

    /**
    * @ORM\ManyToOne(targetEntity=Group::class, inversedBy="groupParticipants")
    * @ORM\JoinColumn(onDelete="CASCADE") 
    */
    protected $group;

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user=$user;
    }

    public function getGroup() {
        return $this->group;
    }

    public function setGroup($group) {
        $this->group=$group;
    }
}