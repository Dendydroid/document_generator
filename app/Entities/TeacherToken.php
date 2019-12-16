<?php
namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repositories\TeacherTokenRepo")
 * @ORM\Table(name="teacher_tokens")
 */
class TeacherToken {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $expiryDate;

    /**
     * Many teacher tokens have one user.
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Column(type="text")
     */
    private $allowedSubjects;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getExpiryDate()
    {
        return $this->expiryDate;
    }

    /**
     * @param mixed $expiryDate
     * @return TeacherToken
     */
    public function setExpiryDate($expiryDate)
    {
        $this->expiryDate = $expiryDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return TeacherToken
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAllowedSubjects()
    {
        return $this->allowedSubjects;
    }

    /**
     * @param mixed $allowedSubjects
     * @return TeacherToken
     */
    public function setAllowedSubjects($allowedSubjects)
    {
        $this->allowedSubjects = $allowedSubjects;
        return $this;
    }



}
