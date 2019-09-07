<?php
namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Validation\Rules\In;
use App\Entities\Faculty;
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
    private $abbreviation;

    /**
     * Many specialities have one faculty. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Faculty", inversedBy="specialities")
     * @ORM\JoinColumn(name="facultyId", referencedColumnName="id")
     */
    private $faculty;

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
     * @return Faculty
     */
    public function getFaculty(): Faculty
    {
        return $this->faculty;
    }

    /**
     * @param Faculty $faculty
     * @return Speciality
     */
    public function setFaculty(Faculty $faculty): Speciality
    {
        $this->faculty = $faculty;
        return $this;
    }

    /**
     * @return array
     */
    public function getGroups(): array
    {
        return $this->groups->getValues();
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

    /**
     * @return array
     */
    public function getTableArray()
    {
        return [
            "id" => $this->id,
            "fullName" => $this->fullName,
            "abbreviation" => $this->abbreviation,
            "faculty" => [
                $this->faculty->getId()."",
                $this->faculty->getFullName()
            ],
        ];
    }
}
