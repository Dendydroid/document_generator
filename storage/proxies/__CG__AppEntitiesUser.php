<?php

namespace DoctrineProxies\__CG__\App\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class User extends \App\Entities\User implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'App\\Entities\\User' . "\0" . 'id', '' . "\0" . 'App\\Entities\\User' . "\0" . 'firstName', '' . "\0" . 'App\\Entities\\User' . "\0" . 'surname', '' . "\0" . 'App\\Entities\\User' . "\0" . 'middleName', '' . "\0" . 'App\\Entities\\User' . "\0" . 'email', '' . "\0" . 'App\\Entities\\User' . "\0" . 'password', '' . "\0" . 'App\\Entities\\User' . "\0" . 'theme', '' . "\0" . 'App\\Entities\\User' . "\0" . 'isAdmin', '' . "\0" . 'App\\Entities\\User' . "\0" . 'isTeacher', '' . "\0" . 'App\\Entities\\User' . "\0" . 'subjects'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Entities\\User' . "\0" . 'id', '' . "\0" . 'App\\Entities\\User' . "\0" . 'firstName', '' . "\0" . 'App\\Entities\\User' . "\0" . 'surname', '' . "\0" . 'App\\Entities\\User' . "\0" . 'middleName', '' . "\0" . 'App\\Entities\\User' . "\0" . 'email', '' . "\0" . 'App\\Entities\\User' . "\0" . 'password', '' . "\0" . 'App\\Entities\\User' . "\0" . 'theme', '' . "\0" . 'App\\Entities\\User' . "\0" . 'isAdmin', '' . "\0" . 'App\\Entities\\User' . "\0" . 'isTeacher', '' . "\0" . 'App\\Entities\\User' . "\0" . 'subjects'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (User $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId(): int
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getSubjects(): array
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSubjects', []);

        return parent::getSubjects();
    }

    /**
     * {@inheritDoc}
     */
    public function getSubjectsCollection()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSubjectsCollection', []);

        return parent::getSubjectsCollection();
    }

    /**
     * {@inheritDoc}
     */
    public function setSubjects(array $subjects): \App\Entities\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSubjects', [$subjects]);

        return parent::setSubjects($subjects);
    }

    /**
     * {@inheritDoc}
     */
    public function addSubject($subject)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addSubject', [$subject]);

        return parent::addSubject($subject);
    }

    /**
     * {@inheritDoc}
     */
    public function getFirstName(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFirstName', []);

        return parent::getFirstName();
    }

    /**
     * {@inheritDoc}
     */
    public function setFirstName(string $firstName): \App\Entities\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFirstName', [$firstName]);

        return parent::setFirstName($firstName);
    }

    /**
     * {@inheritDoc}
     */
    public function getSurname(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSurname', []);

        return parent::getSurname();
    }

    /**
     * {@inheritDoc}
     */
    public function setSurname(string $surname): \App\Entities\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSurname', [$surname]);

        return parent::setSurname($surname);
    }

    /**
     * {@inheritDoc}
     */
    public function getMiddleName(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMiddleName', []);

        return parent::getMiddleName();
    }

    /**
     * {@inheritDoc}
     */
    public function setMiddleName(string $middleName): \App\Entities\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMiddleName', [$middleName]);

        return parent::setMiddleName($middleName);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmail', []);

        return parent::getEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmail(string $email): \App\Entities\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmail', [$email]);

        return parent::setEmail($email);
    }

    /**
     * {@inheritDoc}
     */
    public function getPassword(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPassword', []);

        return parent::getPassword();
    }

    /**
     * {@inheritDoc}
     */
    public function setPassword(string $password): \App\Entities\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPassword', [$password]);

        return parent::setPassword($password);
    }

    /**
     * {@inheritDoc}
     */
    public function isAdmin(): bool
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isAdmin', []);

        return parent::isAdmin();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsAdmin(bool $isAdmin): \App\Entities\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsAdmin', [$isAdmin]);

        return parent::setIsAdmin($isAdmin);
    }

    /**
     * {@inheritDoc}
     */
    public function getTheme()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTheme', []);

        return parent::getTheme();
    }

    /**
     * {@inheritDoc}
     */
    public function setTheme($themeArr)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTheme', [$themeArr]);

        return parent::setTheme($themeArr);
    }

    /**
     * {@inheritDoc}
     */
    public function getUserTableArray()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUserTableArray', []);

        return parent::getUserTableArray();
    }

    /**
     * {@inheritDoc}
     */
    public function getIsTeacher(): bool
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsTeacher', []);

        return parent::getIsTeacher();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsTeacher(bool $isTeacher): \App\Entities\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsTeacher', [$isTeacher]);

        return parent::setIsTeacher($isTeacher);
    }

    /**
     * {@inheritDoc}
     */
    public function getUserArray(): array
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUserArray', []);

        return parent::getUserArray();
    }

}
