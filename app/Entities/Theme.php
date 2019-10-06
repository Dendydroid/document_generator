<?php
namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repositories\ThemeRepo")
 * @ORM\Table(name="themes")
 */
class Theme {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mainBGcolor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $secondBGcolor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $navbarBGcolor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $primaryBGcolor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $secondBGcolorTransparency;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $navbarBGcolorTransparency;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $primaryBGcolorTransparency;


    public function __construct($arr)
    {
        $this->mainBGcolor = $arr['mainBGcolor'];
        $this->secondBGcolor = $arr['secondBGcolor'];
        $this->navbarBGcolor = $arr['navbarBGcolor'];
        $this->primaryBGcolor = $arr['primaryBGcolor'];
        $this->secondBGcolorTransparency = $arr['secondBGcolorTransparency'];
        $this->navbarBGcolorTransparency = $arr['navbarBGcolorTransparency'];
        $this->primaryBGcolorTransparency = $arr['primaryBGcolorTransparency'];
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getMainBGcolor()
    {
        return $this->mainBGcolor;
    }

    /**
     * @param mixed $mainBGcolor
     * @return Theme
     */
    public function setMainBGcolor($mainBGcolor)
    {
        $this->mainBGcolor = $mainBGcolor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSecondBGcolor()
    {
        return $this->secondBGcolor;
    }

    /**
     * @param mixed $secondBGcolor
     * @return Theme
     */
    public function setSecondBGcolor($secondBGcolor)
    {
        $this->secondBGcolor = $secondBGcolor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNavbarBGcolor()
    {
        return $this->navbarBGcolor;
    }

    /**
     * @param mixed $navbarBGcolor
     * @return Theme
     */
    public function setNavbarBGcolor($navbarBGcolor)
    {
        $this->navbarBGcolor = $navbarBGcolor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrimaryBGcolor()
    {
        return $this->primaryBGcolor;
    }

    /**
     * @param mixed $primaryBGcolor
     * @return Theme
     */
    public function setPrimaryBGcolor($primaryBGcolor)
    {
        $this->primaryBGcolor = $primaryBGcolor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSecondBGcolorTransparency()
    {
        return $this->secondBGcolorTransparency;
    }

    /**
     * @param mixed $secondBGcolorTransparency
     * @return Theme
     */
    public function setSecondBGcolorTransparency($secondBGcolorTransparency)
    {
        $this->secondBGcolorTransparency = $secondBGcolorTransparency;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNavbarBGcolorTransparency()
    {
        return $this->navbarBGcolorTransparency;
    }

    /**
     * @param mixed $navbarBGcolorTransparency
     * @return Theme
     */
    public function setNavbarBGcolorTransparency($navbarBGcolorTransparency)
    {
        $this->navbarBGcolorTransparency = $navbarBGcolorTransparency;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrimaryBGcolorTransparency()
    {
        return $this->primaryBGcolorTransparency;
    }

    /**
     * @param mixed $primaryBGcolorTransparency
     * @return Theme
     */
    public function setPrimaryBGcolorTransparency($primaryBGcolorTransparency)
    {
        $this->primaryBGcolorTransparency = $primaryBGcolorTransparency;
        return $this;
    }

    /**
     * @return array
     */
    public function getArrayData(): array
    {
        return [
            "mainBG" => [
                "color" => $this->mainBGcolor
            ],
            "secondBG" => [
                "color" => $this->secondBGcolor,
                "transparency" => $this->secondBGcolorTransparency
            ],
            "navbarBG" => [
                "color" => $this->navbarBGcolor,
                "transparency" => $this->navbarBGcolorTransparency
            ],
            "primaryBG" => [
                "color" => $this->primaryBGcolor,
                "transparency" => $this->primaryBGcolorTransparency
            ],
        ];
    }
}
