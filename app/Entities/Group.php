<?php
namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repositories\GroupRepo")
 * @ORM\Table(name="groups")
 */
class Group {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $idName;

    /**
     * Many groups have one speciality. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Speciality", inversedBy="groups")
     * @ORM\JoinColumn(name="specialityId", referencedColumnName="id")
     */
    private $speciality;

    /**
     * One group has many students. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Student", mappedBy="group")
     */
    private $students;

    /**
     * Many groups have many default subjects.
     * @ORM\ManyToMany(targetEntity="Subject")
     * @ORM\JoinTable(name="groups_subjects",
     *      joinColumns={@ORM\JoinColumn(name="groupId", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="subjectId", referencedColumnName="id", unique=false)}
     *      )
     */
    private $defaultSubjects;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $curatorFIO;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $curatorPhone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $headmanFIO;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $headmanPhone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $eduProgram;

    /**
     * Group constructor.
     */
    public function __construct()
    {
        $this->defaultSubjects = new ArrayCollection();
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
    public function getEduProgram(): string
    {
        return $this->eduProgram;
    }

    /**
     * @param string $eduProgram
     * @return Group
     */
    public function setEduProgram(string $eduProgram): Group
    {
        $this->eduProgram = $eduProgram;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdName(): string
    {
        return $this->idName;
    }

    /**
     * @param string $idName
     * @return Group
     */
    public function setIdName(string $idName): Group
    {
        $this->idName = $idName;
        return $this;
    }

    /**
     * @return Speciality
     */
    public function getSpeciality(): Speciality
    {
        return $this->speciality;
    }

    /**
     * @param Speciality $speciality
     * @return Group
     */
    public function setSpeciality(Speciality $speciality): Group
    {
        $this->speciality = $speciality;
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
     * @return Group
     */
    public function setStudents(array $students): Group
    {
        $this->students->clear();
        foreach ($students as $student)
        {
            $this->students->add($student);
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getDefaultSubjects(): array
    {
        return $this->defaultSubjects->getValues();
    }


    public function getDefaultSubjectsCollection()
    {
        return $this->defaultSubjects;
    }

    /**
     * @param array $defaultSubjects
     * @return Group
     */
    public function setDefaultSubjects(array $defaultSubjects): Group
    {
        $this->defaultSubjects->clear();
        foreach ($defaultSubjects as $defaultSubject)
        {
            $this->defaultSubjects->add($defaultSubject);
        }
        return $this;
    }

    public function addDefaultSubject(Subject $subject): Group
    {
        if(!$this->defaultSubjects->contains($subject)){
            $this->defaultSubjects->add($subject);
        }
        return $this;
    }

    public function addStudent(Student $student)
    {
        $this->students->add($student);
    }

    public function getStudentsCollection()
    {
        return $this->students;
    }

    /**
     * @return string
     */
    public function getCuratorFIO(): string
    {
        return $this->curatorFIO;
    }

    /**
     * @param string $curatorFIO
     * @return Group
     */
    public function setCuratorFIO(string $curatorFIO): Group
    {
        $this->curatorFIO = $curatorFIO;
        return $this;
    }

    /**
     * @return string
     */
    public function getCuratorPhone(): string
    {
        return $this->curatorPhone;
    }

    /**
     * @param string $curatorPhone
     * @return Group
     */
    public function setCuratorPhone(string $curatorPhone): Group
    {
        $this->curatorPhone = $curatorPhone;
        return $this;
    }

    /**
     * @return string
     */
    public function getHeadmanFIO(): string
    {
        return $this->headmanFIO;
    }

    /**
     * @param string $headmanFIO
     * @return Group
     */
    public function setHeadmanFIO(string $headmanFIO): Group
    {
        $this->headmanFIO = $headmanFIO;
        return $this;
    }

    /**
     * @return string
     */
    public function getHeadmanPhone(): string
    {
        return $this->headmanPhone;
    }

    /**
     * @param string $headmanPhone
     * @return Group
     */
    public function setHeadmanPhone(string $headmanPhone): Group
    {
        $this->headmanPhone = $headmanPhone;
        return $this;
    }

    /**
     * @return array
     */
    public function getTableArray()
    {
        $defaultSubjects = $this->defaultSubjects->toArray();
        $defaultSubjectArr = [];
        /**
         * @var Subject $subject
         */
        foreach ($defaultSubjects as $subject)
        {
            $defaultSubjectArr[] = $subject->getTableArray();
        }
        return [
            "id" => $this->id,
            "idName" => $this->idName,
            "speciality" => [
                "id" => $this->speciality->getId(),
                "fullName" => $this->speciality->getFullName(),
                "number" => $this->speciality->getNumber(),
            ],
            "department" => [
                "id" => $this->speciality->getDepartment()->getId(),
                "fullName" => $this->speciality->getDepartment()->getFullName(),
                "head" => $this->speciality->getDepartment()->getHead(),
            ],
            "curator" => [
                "fio" => $this->curatorFIO,
                "phone" => $this->curatorPhone
            ],
            "headman" => [
                "fio" => $this->headmanFIO,
                "phone" => $this->headmanPhone
            ],
            "defaultSubjects" => $defaultSubjectArr,
            "eduProgram" => $this->eduProgram
        ];
    }
}
