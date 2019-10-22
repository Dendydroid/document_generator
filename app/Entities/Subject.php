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
     * @ORM\Column(type="boolean", length=1, nullable=true)
     */
    private $hasCourse;

    /**
     * @ORM\Column(type="boolean", length=1, nullable=true)
     */
    private $hasPass;

    /**
     * @ORM\Column(type="boolean", length=1, nullable=true)
     */
    private $hasExam;

    /**
     * @ORM\Column(type="boolean", length=1, nullable=true)
     */
    private $hasPractice;

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

    /**
     * @return bool
     */
    public function getHasCourse(): bool
    {
        return $this->hasCourse;
    }

    /**
     * @param bool $hasCourse
     * @return Subject
     */
    public function setHasCourse(bool $hasCourse): Subject
    {
        $this->hasCourse = $hasCourse;
        return $this;
    }

    /**
     * @return bool
     */
    public function getHasPass(): bool
    {
        return $this->hasPass;
    }

    /**
     * @param bool $hasPass
     * @return Subject
     */
    public function setHasPass(bool $hasPass): Subject
    {
        $this->hasPass = $hasPass;
        return $this;
    }

    /**
     * @return bool
     */
    public function getHasExam(): bool
    {
        return $this->hasExam;
    }

    /**
     * @param bool $hasExam
     * @return Subject
     */
    public function setHasExam(bool $hasExam): Subject
    {
        $this->hasExam = $hasExam;
        return $this;
    }

    /**
     * @return bool
     */
    public function getHasPractice(): bool
    {
        return $this->hasPractice;
    }

    /**
     * @param bool $hasPractice
     * @return Subject
     */
    public function setHasPractice(bool $hasPractice): Subject
    {
        $this->hasPractice = $hasPractice;
        return $this;
    }
    

    /**
     * @return array
     */
    public function getTableArray()
    {
        $subjectHas = [
            "has" => []
        ];
        if($this->hasCourse){
            $subjectHas["has"]["course"] = true;
        }
        if($this->hasPass){
            $subjectHas["has"]["pass"] = true;
        }
        if($this->hasExam){
            $subjectHas["has"]["exam"] = true;
        }
        if($this->hasPractice){
            $subjectHas["has"]["practice"] = true;
        }

        return array_merge([
            "id" => $this->id,
            "name" => $this->name,
            "professor" => $this->mainProfessor,
            "headOfDepartment" => $this->headOfDepartment,
            "moduleCount" => $this->moduleCount,
            "hoursCount" => $this->hoursCount,
            "creditsCount" => $this->creditsCount,
            "dateBegin" => $this->date,
            
        ], $subjectHas);
    }
}
