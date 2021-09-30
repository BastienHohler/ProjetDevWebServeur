<?php


use Doctrine\ORM\Mapping as ORM;


/**
* @ORM\Entity
* @ORM\Table(name="users")
*/
class User {

	/**
	* @ORM\Id
    * @ORM\GeneratedValue
    * @ORM\Column(type="integer")
    */
    private $id;

	/**
    * @ORM\Column(type="string")
    */
	private $name;

	/**
    * @ORM\Column(type="string")
    */
	private $login;

	/**
    * @ORM\Column(type="string")
    */
	private $pass;


	public function getName() {
		return $name;
	}

	public function setName($name) {
		$this->name=$name;
	}

	public function getId() {
		return $this->id;
	}

	public function getLogin() {
		return $Login;
	}

	public function setLogin($login) {
		$this->login=$login;
	}

	public function getPass() {
		return $pass;
	}

	public function setPass($pass) {
		$this->pass=$pass;
	}

}

?>