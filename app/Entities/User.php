<?php
namespace App\Entities;

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
     * User constructor.
     * @param $id
     */
    public function __construct()
    {
        $this->isAdmin = false;
        $this->theme = new Theme([
            'mainBGcolor' => "#f1f2f6",
            'secondBGcolor' => "#dfe4ea",
            'secondBGcolorTransparency' => 1,
            'navbarBGcolor' => "#f97f51",
            'navbarBGcolorTransparency' => 0.5,
            'primaryBGcolor' => "#7e57c2",
            'primaryBGcolorTransparency' => 1,
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
        $this->theme = new Theme($themeArr);
        return $this;
    }

    public function getUserArray(): array
    {
        return [
            "id" => $this->id,
            "firstName" => $this->firstName,
            "surname" => $this->surname,
            "middleName" => $this->middleName,
            "email" => $this->email,
            "theme" => $this->theme->getArrayData(),
            "isAdmin" => $this->isAdmin
        ];
    }

}
