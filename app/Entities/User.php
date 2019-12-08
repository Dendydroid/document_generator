<?php
namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repositories\UserRepo")
 * @ORM\Table(name="users")
 */
class User {

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
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity="Theme",cascade={"persist"})
     * @ORM\JoinColumn(name="themeId", referencedColumnName="id")
     */
    private $theme;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAdmin;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isTeacher;

    /**
     * Many teacher users have many subjects.
     * @ORM\ManyToMany(targetEntity="Subject")
     * @ORM\JoinTable(name="users_subjects",
     *      joinColumns={@ORM\JoinColumn(name="userId", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="subjectId", referencedColumnName="id", unique=true, onDelete="CASCADE")}
     *      )
     */
    private $subjects;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->subjects = new ArrayCollection();
        $this->isAdmin = false;
        $this->theme = new Theme([
            'mainBGcolor' => "#f1f2f6",
            'secondBGcolor' => "#dfe4ea",
            'secondBGcolorTransparency' => 1,
            'navbarBGcolor' => "#f97f51",
            'navbarBGcolorTransparency' => 0.5,
            'primaryBGcolor' => "#7e57c2",
            'primaryBGcolorTransparency' => 1,
            'accentBGcolor' => "#ff5252",
            'accentBGcolorTransparency' => 1,
        ]);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getSubjects(): array
    {
        $subjects = [];
        foreach ($this->subjects as $subject) {
            $subjects[] = $subject->getTableArray();
        }
        return $subjects;
    }

    public function getSubjectsCollection()
    {
        return $this->subjects;
    }

    /**
     * @param array $subjects
     * @return User
     */
    public function setSubjects(array $subjects): User
    {
        $this->subjects->clear();
        foreach ($subjects as $subject)
        {
            $this->subjects->add($subject);
        }
        return $this;
    }

    public function addSubject($subject)
    {
        $this->subjects->add($subject);
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
     * @return User
     */
    public function setFirstName(string $firstName): User
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
     * @return User
     */
    public function setSurname(string $surname): User
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
     * @return User
     */
    public function setMiddleName(string $middleName): User
    {
        $this->middleName = $middleName;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }

    /**
     * @param bool $isAdmin
     * @return User
     */
    public function setIsAdmin(bool $isAdmin): User
    {
        $this->isAdmin = $isAdmin;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTheme()
    {
        return $this->theme->getArrayData();
    }

    /**
     * @param $themeArr
     * @return $this
     */
    public function setTheme($themeArr)
    {
        $this->theme->setTheme($themeArr);
        return $this;
    }

    public function getUserTableArray()
    {
        return [
            "id" => $this->id,
            "FIO" => "$this->surname $this->firstName $this->middleName",
            "email" => $this->email,
            "isAdmin" => $this->isAdmin
        ];
    }

    /**
     * @return bool
     */
    public function getIsTeacher(): bool
    {
        return $this->isTeacher;
    }

    /**
     * @param bool $isTeacher
     * @return User
     */
    public function setIsTeacher(bool $isTeacher): User
    {
        $this->isTeacher = $isTeacher;
        return $this;
    }

    public function getUserArray(): array
    {
        $subjects = $this->subjects->toArray();
        $subjectsArr = [];
        /**
         * @var Subject $subject
         */
        foreach ($subjects as $subject)
        {
            $subjectsArr[] = $subject->getTableArray();
        }
        return [
            "id" => $this->id,
            "firstName" => $this->firstName,
            "surname" => $this->surname,
            "middleName" => $this->middleName,
            "email" => $this->email,
            "theme" => $this->theme->getArrayData(),
            "isAdmin" => $this->isAdmin,
            "isTeacher" => $this->isTeacher,
            "subjects" => $subjectsArr
        ];
    }

}
