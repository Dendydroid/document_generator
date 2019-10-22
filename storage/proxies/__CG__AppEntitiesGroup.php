<?php

namespace DoctrineProxies\__CG__\App\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Group extends \App\Entities\Group implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'App\\Entities\\Group' . "\0" . 'id', '' . "\0" . 'App\\Entities\\Group' . "\0" . 'idName', '' . "\0" . 'App\\Entities\\Group' . "\0" . 'speciality', '' . "\0" . 'App\\Entities\\Group' . "\0" . 'students', '' . "\0" . 'App\\Entities\\Group' . "\0" . 'defaultSubjects', '' . "\0" . 'App\\Entities\\Group' . "\0" . 'curatorFIO', '' . "\0" . 'App\\Entities\\Group' . "\0" . 'curatorPhone', '' . "\0" . 'App\\Entities\\Group' . "\0" . 'headmanFIO', '' . "\0" . 'App\\Entities\\Group' . "\0" . 'headmanPhone', '' . "\0" . 'App\\Entities\\Group' . "\0" . 'eduProgram'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Entities\\Group' . "\0" . 'id', '' . "\0" . 'App\\Entities\\Group' . "\0" . 'idName', '' . "\0" . 'App\\Entities\\Group' . "\0" . 'speciality', '' . "\0" . 'App\\Entities\\Group' . "\0" . 'students', '' . "\0" . 'App\\Entities\\Group' . "\0" . 'defaultSubjects', '' . "\0" . 'App\\Entities\\Group' . "\0" . 'curatorFIO', '' . "\0" . 'App\\Entities\\Group' . "\0" . 'curatorPhone', '' . "\0" . 'App\\Entities\\Group' . "\0" . 'headmanFIO', '' . "\0" . 'App\\Entities\\Group' . "\0" . 'headmanPhone', '' . "\0" . 'App\\Entities\\Group' . "\0" . 'eduProgram'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Group $proxy) {
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
    public function getEduProgram(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEduProgram', []);

        return parent::getEduProgram();
    }

    /**
     * {@inheritDoc}
     */
    public function setEduProgram(string $eduProgram): \App\Entities\Group
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEduProgram', [$eduProgram]);

        return parent::setEduProgram($eduProgram);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdName(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdName', []);

        return parent::getIdName();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdName(string $idName): \App\Entities\Group
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdName', [$idName]);

        return parent::setIdName($idName);
    }

    /**
     * {@inheritDoc}
     */
    public function getSpeciality(): \App\Entities\Speciality
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSpeciality', []);

        return parent::getSpeciality();
    }

    /**
     * {@inheritDoc}
     */
    public function setSpeciality(\App\Entities\Speciality $speciality): \App\Entities\Group
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSpeciality', [$speciality]);

        return parent::setSpeciality($speciality);
    }

    /**
     * {@inheritDoc}
     */
    public function getStudents(): \Doctrine\Common\Collections\ArrayCollection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStudents', []);

        return parent::getStudents();
    }

    /**
     * {@inheritDoc}
     */
    public function setStudents(array $students): \App\Entities\Group
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStudents', [$students]);

        return parent::setStudents($students);
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultSubjects(): array
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDefaultSubjects', []);

        return parent::getDefaultSubjects();
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultSubjectsCollection()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDefaultSubjectsCollection', []);

        return parent::getDefaultSubjectsCollection();
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultSubjects(array $defaultSubjects): \App\Entities\Group
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDefaultSubjects', [$defaultSubjects]);

        return parent::setDefaultSubjects($defaultSubjects);
    }

    /**
     * {@inheritDoc}
     */
    public function addDefaultSubject(\App\Entities\Subject $subject): \App\Entities\Group
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addDefaultSubject', [$subject]);

        return parent::addDefaultSubject($subject);
    }

    /**
     * {@inheritDoc}
     */
    public function addStudent(\App\Entities\Student $student)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addStudent', [$student]);

        return parent::addStudent($student);
    }

    /**
     * {@inheritDoc}
     */
    public function getStudentsCollection()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStudentsCollection', []);

        return parent::getStudentsCollection();
    }

    /**
     * {@inheritDoc}
     */
    public function getCuratorFIO(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCuratorFIO', []);

        return parent::getCuratorFIO();
    }

    /**
     * {@inheritDoc}
     */
    public function setCuratorFIO(string $curatorFIO): \App\Entities\Group
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCuratorFIO', [$curatorFIO]);

        return parent::setCuratorFIO($curatorFIO);
    }

    /**
     * {@inheritDoc}
     */
    public function getCuratorPhone(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCuratorPhone', []);

        return parent::getCuratorPhone();
    }

    /**
     * {@inheritDoc}
     */
    public function setCuratorPhone(string $curatorPhone): \App\Entities\Group
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCuratorPhone', [$curatorPhone]);

        return parent::setCuratorPhone($curatorPhone);
    }

    /**
     * {@inheritDoc}
     */
    public function getHeadmanFIO(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHeadmanFIO', []);

        return parent::getHeadmanFIO();
    }

    /**
     * {@inheritDoc}
     */
    public function setHeadmanFIO(string $headmanFIO): \App\Entities\Group
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHeadmanFIO', [$headmanFIO]);

        return parent::setHeadmanFIO($headmanFIO);
    }

    /**
     * {@inheritDoc}
     */
    public function getHeadmanPhone(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHeadmanPhone', []);

        return parent::getHeadmanPhone();
    }

    /**
     * {@inheritDoc}
     */
    public function setHeadmanPhone(string $headmanPhone): \App\Entities\Group
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHeadmanPhone', [$headmanPhone]);

        return parent::setHeadmanPhone($headmanPhone);
    }

    /**
     * {@inheritDoc}
     */
    public function getTableArray()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTableArray', []);

        return parent::getTableArray();
    }

}
