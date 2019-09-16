<?php
namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repositories\FacultyRepo")
 * @ORM\Table(name="faculties")
 */
class Faculty {

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
     * @return Faculty
     */
    public function setFullName(string $fullName): Faculty
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
     * @return Faculty
     */
    public function setAbbreviation(string $abbreviation): Faculty
    {
        $this->abbreviation = $abbreviation;
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
     * @return Faculty
     */
    public function setSpecialities(array $specialities): Faculty
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
            "abbreviation" => $this->abbreviation
        ];
    }
}
