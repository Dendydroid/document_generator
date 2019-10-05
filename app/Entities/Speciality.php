<?php
namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Validation\Rules\In;
use App\Entities\Department;
/**
 * @ORM\Entity(repositoryClass="App\Repositories\SpecialityRepo")
 * @ORM\Table(name="specialities")
 */
class Speciality {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $eduProgram;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $abbreviation;

    /**
     * Many specialities have one department. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Department", inversedBy="specialities")
     * @ORM\JoinColumn(name="departmentId", referencedColumnName="id")
     */
    private $department;

    /**
     * One speciality has many groups. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Group", mappedBy="speciality")
     */
    private $groups;

    /**
     * Speciality constructor.
     */
    public function __construct()
    {
        $this->groups = new ArrayCollection();
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
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     * @return Speciality
     */
    public function setFullName(string $fullName): Speciality
    {
        $this->fullName = $fullName;
        return $this;
    }

    /**
     * @return string
     */
    public function getAbbreviation(): string
    {
        return $this->abbreviation;
    }

    /**
     * @param string $abbreviation
     * @return Speciality
     */
    public function setAbbreviation(string $abbreviation): Speciality
    {
        $this->abbreviation = $abbreviation;
        return $this;
    }

    /**
     * @return Department
     */
    public function getDepartment(): Department
    {
        return $this->department;
    }

    /**
     * @param Department $department
     * @return Speciality
     */
    public function setDepartment(Department $department): Speciality
    {
        $this->department = $department;
        return $this;
    }

    /**
     * @return array
     */
    public function getGroups(): array
    {
        return $this->groups->getValues();
    }


    public function getGroupsCollection()
    {
        return $this->groups;
    }

    /**
     * @param array $groups
     * @return Speciality
     */
    public function setGroups(array $groups): Speciality
    {
        $this->groups->clear();
        foreach ($groups as $group)
        {
            $this->groups->add($group);
        }
        return $this;
    }


    public function addGroup(Group $group): Speciality
    {
        $this->groups->add($group);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return Speciality
     */
    public function setNumber(string $number): Speciality
    {
        $this->number = $number;
        return $this;
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
     * @return Speciality
     */
    public function setEduProgram(string $eduProgram): Speciality
    {
        $this->eduProgram = $eduProgram;
        return $this;
    }

    /**
     * @return array
     */
    public function getTableArray()
    {
        return [
            "id" => $this->id,
            "fullName" => $this->fullName,
            "abbreviation" => $this->abbreviation,
            "number" => $this->number,
            "eduProgram" => $this->eduProgram,
            "department" => [
                "id" => $this->department->getId(),
                "fullName" => $this->department->getFullName()
            ],
        ];
    }
}
