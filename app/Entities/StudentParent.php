<?php
namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repositories\StudentParentRepo")
 * @ORM\Table(name="student_parents")
 */
class StudentParent {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $middleName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dateOfBirth;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $job;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $jobPosition;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phoneNumber;

    /**
     * Many parents have many students.
     * @ORM\ManyToMany(targetEntity="Student", mappedBy="parents")
     */
    private $students;

    /**
     * StudentParent constructor.
     */
    public function __construct()
    {
        $this->students = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return StudentParent
     */
    public function setFirstName(string $firstName): StudentParent
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     * @return StudentParent
     */
    public function setSurname(string $surname): StudentParent
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @return string
     */
    public function getMiddleName(): string
    {
        return $this->middleName;
    }

    /**
     * @param string $middleName
     * @return StudentParent
     */
    public function setMiddleName(string $middleName): StudentParent
    {
        $this->middleName = $middleName;
        return $this;
    }

    /**
     * @return string
     */
    public function getDateOfBirth(): string
    {
        return $this->dateOfBirth;
    }

    /**
     * @param string $dateOfBirth
     * @return StudentParent
     */
    public function setDateOfBirth(string $dateOfBirth): StudentParent
    {
        $this->dateOfBirth = $dateOfBirth;
        return $this;
    }

    /**
     * @return string
     */
    public function getJob(): string
    {
        return $this->job;
    }

    /**
     * @param string $job
     * @return StudentParent
     */
    public function setJob(string $job): StudentParent
    {
        $this->job = $job;
        return $this;
    }

    /**
     * @return string
     */
    public function getJobPosition(): string
    {
        return $this->jobPosition;
    }

    /**
     * @param string $jobPosition
     * @return StudentParent
     */
    public function setJobPosition(string $jobPosition): StudentParent
    {
        $this->jobPosition = $jobPosition;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return StudentParent
     */
    public function setAddress(string $address): StudentParent
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     * @return StudentParent
     */
    public function setPhoneNumber(string $phoneNumber): StudentParent
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @return array
     */
    public function getStudents(): array
    {
        return $this->students->getValues();
    }

    /**
     * @param array $students
     * @return StudentParent
     */
    public function setStudents(array $students): StudentParent
    {
        $this->students->clear();
        foreach ($students as $student)
        {
            $this->students->add($students);
        }
        return $this;
    }
}
