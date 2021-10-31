<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Option
 * @ORM\Entity @ORM\Table(name="friends")
 */
class Friend
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
     * @ORM\JoinColumn(onDelete="CASCADE") 
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(onDelete="CASCADE") 
     */
    private $friend;


    public function getIdFriend() {
        return $this->id;
    }
    public function setIdFriend( $id ) {
        $this->id = $id;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setFriend(User $friend)
    {
        $this->friend = $friend;
    }

    public function getFriend()
    {
        return $this->friend;
    }

}
