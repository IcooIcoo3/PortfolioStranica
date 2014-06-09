<?php

namespace Icoo\UpitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="poruke")
 */

class UpitEntity
{
	/**
	    * @ORM\Column(type="integer")
	    * @ORM\Id
	    * @ORM\GeneratedValue(strategy="AUTO")
	*/
	private $id;
	/**
	   * @ORM\Column(type="string", length=100)
	*/
	private $ime;
	/**
	   * @ORM\Column(type="string", length=100)
	*/
	private $email;
	/**
	   * @ORM\Column(type="text")
	*/
	private $upit;

	/**
	   * @ORM\Column(type="date")
	*/
	private $datum;

	public function __construct() {
		$this->datum = new \DateTime();
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getId() {
		return $this->id;
	}

	public function setIme($ime) {
		$this->ime = $ime;
	}

	public function getIme() {
		return $this->ime;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setUpit($upit) {
		$this->upit = $upit;
	}

	public function getUpit() {
		return $this->upit;
	}

	public function getDatum() {
		return $this->datum->format('d-m-Y');
	}
}