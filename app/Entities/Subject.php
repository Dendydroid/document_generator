<?php
namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repositories\SubjectRepo")
 * @ORM\Table(name="subjects")
 */
class Subject {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mainProfessor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $headOfDepartment;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    private $moduleCount;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    private $hoursCount;

    /**
     * @ORM\Column(type="integer", length=11)
     */
    private $creditsCount;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Subject
     */
    public function setName(string $name): Subject
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getMainProfessor(): string
    {
        return $this->mainProfessor;
    }

    /**
     * @param string $mainProfessor
     * @return Subject
     */
    public function setMainProfessor(string $mainProfessor): Subject
    {
        $this->mainProfessor = $mainProfessor;
        return $this;
    }

    /**
     * @return string
     */
    public function getHeadOfDepartment(): string
    {
        return $this->headOfDepartment;
    }

    /**
     * @param string $headOfDepartment
     * @return Subject
     */
    public function setHeadOfDepartment(string $headOfDepartment): Subject
    {
        $this->headOfDepartment = $headOfDepartment;
        return $this;
    }

    /**
     * @return int
     */
    public function getModuleCount(): int
    {
        return $this->moduleCount;
    }

    /**
     * @param int $moduleCount
     * @return Subject
     */
    public function setModuleCount(int $moduleCount): Subject
    {
        $this->moduleCount = $moduleCount;
        return $this;
    }

    /**
     * @return int
     */
    public function getHoursCount(): int
    {
        return $this->hoursCount;
    }

    /**
     * @param int $hoursCount
     * @return Subject
     */
    public function setHoursCount(int $hoursCount): Subject
    {
        $this->hoursCount = $hoursCount;
        return $this;
    }

    /**
     * @return int
     */
    public function getCreditsCount(): int
    {
        return $this->creditsCount;
    }

    /**
     * @param int $creditsCount
     * @return Subject
     */
    public function setCreditsCount(int $creditsCount): Subject
    {
        $this->creditsCount = $creditsCount;
        return $this;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return Subject
     */
    public function setDate(string $date): Subject
    {
        $this->date = $date;
        return $this;
    }

}
