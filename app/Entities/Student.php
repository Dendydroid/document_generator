<?php
namespace App\Entities;

use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Support\Arr;

/**
 * @ORM\Entity(repositoryClass="App\Repositories\StudentRepo")
 * @ORM\Table(name="students")
 */
class Student {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $middleName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $idNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dateOfBirth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $citizenship;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $familyState;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $marriageAddress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $addressUniversityBegin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $beforeNauEduInfo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $beforeNauJobInfo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $militaryServiceDates;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nauEntryConditionsInfo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nauEduContractInfo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $privilegesInfo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hostelInfo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $additionalInfo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $creationDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $preparationAbbrev;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $specialityAbbrev;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $specializationInfo;

    /**
     * Many students have many additional subjects.
     * @ORM\ManyToMany(targetEntity="Subject")
     * @ORM\JoinTable(name="students_subjects",
     *      joinColumns={@ORM\JoinColumn(name="studentId", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="subjectId", referencedColumnName="id", unique=true)}
     *      )
     */
    private $additionalSubjects;

    /**
     * Many students have many encouragement/penalty orders.
     * @ORM\ManyToMany(targetEntity="Order")
     * @ORM\JoinTable(name="students_encouragement_penalty_orders",
     *      joinColumns={@ORM\JoinColumn(name="studentId", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="orderId", referencedColumnName="id", unique=false)}
     *      )
     */
    private $encouragementPenaltyList;

    /**
     * Many students have many parents.
     * @ORM\ManyToMany(targetEntity="StudentParent", inversedBy="students")
     * @ORM\JoinTable(name="students_parents")
     */
    private $parents;

    /**
     * Many students have many other orders.
     * @ORM\ManyToMany(targetEntity="Order")
     * @ORM\JoinTable(name="students_other_orders",
     *      joinColumns={@ORM\JoinColumn(name="studentId", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="orderId", referencedColumnName="id", unique=false)}
     *      )
     */
    private $otherOrderList;

    /**
     * Many students have one group. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Group", inversedBy="students")
     * @ORM\JoinColumn(name="groupId", referencedColumnName="id")
     */
    private $group;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $studyType;

    /**
     * Student constructor.
     */
    public function __construct()
    {
        $this->creationDate = Carbon::now()->format('d/m/Y H:i:s');
        $this->parents = new ArrayCollection();
        $this->encouragementPenaltyList = new ArrayCollection();
        $this->otherOrderList = new ArrayCollection();
        $this->additionalSubjects = new ArrayCollection();
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
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Student
     */
    public function setFirstName(string $firstName): Student
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     * @return Student
     */
    public function setSurname(string $surname): Student
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @return string
     */
    public function getMiddleName(): string
    {
        return $this->middleName;
    }

    /**
     * @param string $middleName
     * @return Student
     */
    public function setMiddleName(string $middleName): Student
    {
        $this->middleName = $middleName;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdNumber(): string
    {
        return $this->idNumber;
    }

    /**
     * @param string $idNumber
     * @return Student
     */
    public function setIdNumber(string $idNumber): Student
    {
        $this->idNumber = $idNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getDateOfBirth(): string
    {
        return $this->dateOfBirth;
    }

    /**
     * @param string $dateOfBirth
     * @return Student
     */
    public function setDateOfBirth(string $dateOfBirth): Student
    {
        $this->dateOfBirth = $dateOfBirth;
        return $this;
    }

    /**
     * @return string
     */
    public function getCitizenship(): string
    {
        return $this->citizenship;
    }

    /**
     * @param string $citizenship
     * @return Student
     */
    public function setCitizenship(string $citizenship): Student
    {
        $this->citizenship = $citizenship;
        return $this;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return Student
     */
    public function setGender(string $gender): Student
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return string
     */
    public function getFamilyState(): string
    {
        return $this->familyState;
    }

    /**
     * @param string $familyState
     * @return Student
     */
    public function setFamilyState(string $familyState): Student
    {
        $this->familyState = $familyState;
        return $this;
    }

    /**
     * @return string
     */
    public function getMarriageAddress(): string
    {
        return $this->marriageAddress;
    }

    /**
     * @param string $marriageAddress
     * @return Student
     */
    public function setMarriageAddress(string $marriageAddress): Student
    {
        $this->marriageAddress = $marriageAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressUniversityBegin(): string
    {
        return $this->addressUniversityBegin;
    }

    /**
     * @param string $addressUniversityBegin
     * @return Student
     */
    public function setAddressUniversityBegin(string $addressUniversityBegin): Student
    {
        $this->addressUniversityBegin = $addressUniversityBegin;
        return $this;
    }

    /**
     * @return string
     */
    public function getBeforeNauEduInfo(): string
    {
        return $this->beforeNauEduInfo;
    }

    /**
     * @param string $beforeNauEduInfo
     * @return Student
     */
    public function setBeforeNauEduInfo(string $beforeNauEduInfo): Student
    {
        $this->beforeNauEduInfo = $beforeNauEduInfo;
        return $this;
    }

    /**
     * @return string
     */
    public function getBeforeNauJobInfo(): string
    {
        return $this->beforeNauJobInfo;
    }

    /**
     * @param string $beforeNauJobInfo
     * @return Student
     */
    public function setBeforeNauJobInfo(string $beforeNauJobInfo): Student
    {
        $this->beforeNauJobInfo = $beforeNauJobInfo;
        return $this;
    }

    /**
     * @return string
     */
    public function getMilitaryServiceDates(): string
    {
        return $this->militaryServiceDates;
    }

    /**
     * @param string $militaryServiceDates
     * @return Student
     */
    public function setMilitaryServiceDates(string $militaryServiceDates): Student
    {
        $this->militaryServiceDates = $militaryServiceDates;
        return $this;
    }

    /**
     * @return string
     */
    public function getNauEntryConditionsInfo(): string
    {
        return $this->nauEntryConditionsInfo;
    }

    /**
     * @param string $nauEntryConditionsInfo
     * @return Student
     */
    public function setNauEntryConditionsInfo(string $nauEntryConditionsInfo): Student
    {
        $this->nauEntryConditionsInfo = $nauEntryConditionsInfo;
        return $this;
    }

    /**
     * @return string
     */
    public function getNauEduContractInfo(): string
    {
        return $this->nauEduContractInfo;
    }

    /**
     * @param string $nauEduContractInfo
     * @return Student
     */
    public function setNauEduContractInfo(string $nauEduContractInfo): Student
    {
        $this->nauEduContractInfo = $nauEduContractInfo;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrivilegesInfo(): string
    {
        return $this->privilegesInfo;
    }

    /**
     * @param string $privilegesInfo
     * @return Student
     */
    public function setPrivilegesInfo(string $privilegesInfo): Student
    {
        $this->privilegesInfo = $privilegesInfo;
        return $this;
    }

    /**
     * @return string
     */
    public function getHostelInfo(): string
    {
        return $this->hostelInfo;
    }

    /**
     * @param string $hostelInfo
     * @return Student
     */
    public function setHostelInfo(string $hostelInfo): Student
    {
        $this->hostelInfo = $hostelInfo;
        return $this;
    }

    /**
     * @return string
     */
    public function getAdditionalInfo(): string
    {
        return $this->additionalInfo;
    }

    /**
     * @param string $additionalInfo
     * @return Student
     */
    public function setAdditionalInfo(string $additionalInfo): Student
    {
        $this->additionalInfo = $additionalInfo;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreationDate(): string
    {
        return $this->creationDate;
    }

    /**
     * @param string $creationDate
     * @return Student
     */
    public function setCreationDate(string $creationDate): Student
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getPreparationAbbrev(): string
    {
        return $this->preparationAbbrev;
    }

    /**
     * @param string $preparationAbbrev
     * @return Student
     */
    public function setPreparationAbbrev(string $preparationAbbrev): Student
    {
        $this->preparationAbbrev = $preparationAbbrev;
        return $this;
    }

    /**
     * @return string
     */
    public function getSpecialityAbbrev(): string
    {
        return $this->specialityAbbrev;
    }

    /**
     * @param string $specialityAbbrev
     * @return Student
     */
    public function setSpecialityAbbrev(string $specialityAbbrev): string
    {
        $this->specialityAbbrev = $specialityAbbrev;
        return $this;
    }

    /**
     * @return string
     */
    public function getSpecializationInfo(): string
    {
        return $this->specializationInfo;
    }

    /**
     * @param string $specializationInfo
     * @return Student
     */
    public function setSpecializationInfo(string $specializationInfo): Student
    {
        $this->specializationInfo = $specializationInfo;
        return $this;
    }

    /**
     * @return array
     */
    public function getEncouragementPenaltyList(): array
    {
        return $this->encouragementPenaltyList->getValues();
    }

    /**
     * @return string
     */
    public function getStudyType(): string
    {
        return $this->studyType;
    }

    /**
     * @param string $studyType
     * @return Student
     */
    public function setStudyType(string $studyType): Student
    {
        $this->studyType = $studyType;
        return $this;
    }

    /**
     * @param array $encouragementPenaltyList
     * @return Student
     */
    public function setEncouragementPenaltyList(array $encouragementPenaltyList): Student
    {
        $this->encouragementPenaltyList->clear();
        foreach ($encouragementPenaltyList as $encouragementPenaltyOrder)
        {
            $this->encouragementPenaltyList->add($encouragementPenaltyOrder);
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getParents(): array
    {
        return $this->parents->getValues();
    }

    /**
     * @param array $parents
     * @return Student
     */
    public function setParents(array $parents): Student
    {
        $this->parents->clear();
        foreach ($parents as $parent)
        {
            $this->parents->add($parent);
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getAdditionalSubjects(): array
    {
        return $this->additionalSubjects->getValues();
    }

    public function getAdditionalSubjectsCollection()
    {
        return $this->additionalSubjects;
    }

    /**
     * @param array $subjects
     * @return Student
     */
    public function setAdditionalSubjects(array $subjects): Student
    {
        $this->additionalSubjects->clear();
        foreach ($subjects as $subject)
        {
            $this->additionalSubjects->add($subject);
        }
        return $this;
    }

    public function addAdditionalSubject($subject)
    {
        $this->additionalSubjects->add($subject);
    }

    /**
     * @return array
     */
    public function getOtherOrderList(): array
    {
        return $this->otherOrderList->getValues();
    }

    /**
     * @param array $otherOrderList
     * @return Student
     */
    public function setOtherOrderList(array $otherOrderList): Student
    {
        $this->otherOrderList->clear();
        foreach ($otherOrderList as $otherOrder)
        {
            $this->otherOrderList->add($otherOrder);
        }
        return $this;
    }

    /**
     * @return Group
     */
    public function getGroup(): Group
    {
        return $this->group;
    }

    /**
     * @param Group $group
     * @return Student
     */
    public function setGroup(Group $group): Student
    {
        $this->group = $group;
        return $this;
    }

    /**
     * @return array
     */
    public function getTableArray()
    {
        $additionalSubjects = $this->additionalSubjects->toArray();
        $additionalSubjectArr = [];
        /**
         * @var Subject $subject
         */
        foreach ($additionalSubjects as $subject)
        {
            $additionalSubjectArr[] = $subject->getTableArray();
        }
        return [
            "id" => $this->id,
            "firstName" => $this->firstName,
            "surname" => $this->surname,
            "middleName" => $this->middleName,
            "studentId" => $this->idNumber,
            "dateOfBirth" => $this->dateOfBirth,
            "citizenship" => $this->citizenship,
            "gender" => $this->gender,
            "familyState" => $this->familyState,
            "familyAddress" => $this->marriageAddress,
            "addressBegin" => $this->addressUniversityBegin,
            "beforeNauEdu" => $this->beforeNauEduInfo,
            "beforeNauJob" => $this->beforeNauJobInfo,
            "militaryService" => $this->militaryServiceDates,
            "nauConditions" => $this->nauEntryConditionsInfo,
            "nauContract" => $this->nauEduContractInfo,
            "nauPrivileges" => $this->privilegesInfo,
            "hostel" => $this->hostelInfo,
            "additionalInfo" => $this->additionalInfo,
            "creationDate" => $this->creationDate,
            "group" => [
                "id" => $this->group->getId(),
                "idName" => $this->group->getIdName(),
            ],
            "additionalSubjects" => $additionalSubjectArr,
            "studyType" => $this->studyType
        ];
    }
}
