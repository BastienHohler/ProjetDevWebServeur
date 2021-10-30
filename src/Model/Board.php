<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Option
 * @ORM\Entity @ORM\Table(name="boards")
 */
class Board
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
     * @ORM\Column(name="contends", type="string")
     */
    private $contends;

    /**
     * @ORM\OneToOne(targetEntity="Group")
     * @var Group An Group of Group objects.
     */
    private $group;


    public function getIdBoard() {
        return $this->id;
    }
    public function setIdBoard( $id ) {
        $this->id = $id;
    }

    public function getContends() {
        return $this->contends;
    }
    public function setContends( $contends ) {
        $this->contends = $contends;
    }

    public function getGroup() {
        return $this->group;
    }
    public function setGroup( Group $group ) {
        $this->group = $group;
    }


}
