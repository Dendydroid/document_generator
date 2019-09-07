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
     *      inverseJoinColumns={@ORM\JoinColumn(name="subjectId", referencedColumnName="id", unique=true)}
     *      )
     */
    private $defaultSubjects;

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
     * @return string
     */
    public function getSpeciality(): string
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
     * @return ArrayCollection
     */
    public function getStudents(): ArrayCollection
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
}
