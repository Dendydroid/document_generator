<?php
namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repositories\GroupDisciplineMarksRepo")
 * @ORM\Table(name="group_discipline_marks")
 */
class GroupDisciplineMarks {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Many group-discipline-marks have one group.
     * @ORM\ManyToOne(targetEntity="Group")
     * @ORM\JoinColumn(name="groupId", referencedColumnName="id")
     */
    private $group;

    /**
     * Many group-discipline-marks have one subject.
     * @ORM\ManyToOne(targetEntity="Subject")
     * @ORM\JoinColumn(name="subjectId", referencedColumnName="id")
     */
    private $subject;

    /**
     * Many group-discipline-marks have one user.
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $generatedAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $studentData;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     * @return GroupDisciplineMarks
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param mixed $group
     * @return GroupDisciplineMarks
     */
    public function setGroup($group)
    {
        $this->group = $group;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     * @return GroupDisciplineMarks
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return GroupDisciplineMarks
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGeneratedAt()
    {
        return $this->generatedAt;
    }

    /**
     * @param mixed $generatedAt
     * @return GroupDisciplineMarks
     */
    public function setGeneratedAt($generatedAt)
    {
        $this->generatedAt = $generatedAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStudentData()
    {
        return $this->studentData;
    }

    /**
     * @param mixed $studentData
     * @return GroupDisciplineMarks
     */
    public function setStudentData($studentData)
    {
        $this->studentData = $studentData;
        return $this;
    }

    public function getArrayData()
    {
        return [
            "id" => $this->id,
            "generatedAt" => $this->generatedAt,
            "studentData" => $this->studentData,
            "groupId" => $this->group->getId(),
            "subjectId" => $this->subject->getId(),
            "userId" => $this->user->getId(),
            "number" => $this->number,
        ];
    }
}
