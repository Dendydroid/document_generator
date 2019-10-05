<?php
namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repositories\DepartmentRepo")
 * @ORM\Table(name="departments")
 */
class Department {

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
     * @ORM\Column(type="string", length=255)
     */
    private $head;

    /**
     * One faculty has many specialities. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Speciality", mappedBy="faculty")
     */
    private $specialities;

    /**
     * Faculty constructor.
     */
    public function __construct()
    {
        $this->specialities = new ArrayCollection();
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
     * @return Department
     */
    public function setFullName(string $fullName): Department
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
     * @return Department
     */
    public function setAbbreviation(string $abbreviation): Department
    {
        $this->abbreviation = $abbreviation;
        return $this;
    }

    /**
     * @return string
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /**
     * @param string $head
     * @return Department
     */
    public function setHead(string $head): Department
    {
        $this->head = $head;
        return $this;
    }

    /**
     * @return array
     */
    public function getSpecialities(): array
    {
        return $this->specialities->getValues();
    }


    public function getSpecialitiesCollection()
    {
        return $this->specialities;
    }

    /**
     * @param Speciality $speciality
     */
    public function addSpeciality(Speciality $speciality)
    {
        $this->specialities->add($speciality);
    }

    /**
     * @param array $specialities
     * @return Department
     */
    public function setSpecialities(array $specialities): Department
    {
        $this->specialities->clear();
        foreach ($specialities as $speciality)
        {
            $this->specialities->add($speciality);
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
            "head" => $this->head
        ];
    }
}
