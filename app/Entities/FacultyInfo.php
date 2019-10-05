<?php
namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repositories\FacultyInfoRepo")
 * @ORM\Table(name="faculty_info")
 */
class FacultyInfo {

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
    private $rectorFIO;

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
     * @return FacultyInfo
     */
    public function setFullName(string $fullName): FacultyInfo
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
     * @return FacultyInfo
     */
    public function setAbbreviation(string $abbreviation): string
    {
        $this->abbreviation = $abbreviation;
        return $this;
    }

    /**
     * @return string
     */
    public function getRectorFIO(): string
    {
        return $this->rectorFIO;
    }

    /**
     * @param string $rectorFIO
     * @return FacultyInfo
     */
    public function setRectorFIO(string $rectorFIO): FacultyInfo
    {
        $this->rectorFIO = $rectorFIO;
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
            "rectorFIO" => $this->rectorFIO,
        ];
    }
}
