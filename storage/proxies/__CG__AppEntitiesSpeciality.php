<?php

namespace DoctrineProxies\__CG__\App\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Speciality extends \App\Entities\Speciality implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
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
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
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
            return ['__isInitialized__', '' . "\0" . 'App\\Entities\\Speciality' . "\0" . 'id', '' . "\0" . 'App\\Entities\\Speciality' . "\0" . 'fullName', '' . "\0" . 'App\\Entities\\Speciality' . "\0" . 'abbreviation', '' . "\0" . 'App\\Entities\\Speciality' . "\0" . 'faculty', '' . "\0" . 'App\\Entities\\Speciality' . "\0" . 'groups'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Entities\\Speciality' . "\0" . 'id', '' . "\0" . 'App\\Entities\\Speciality' . "\0" . 'fullName', '' . "\0" . 'App\\Entities\\Speciality' . "\0" . 'abbreviation', '' . "\0" . 'App\\Entities\\Speciality' . "\0" . 'faculty', '' . "\0" . 'App\\Entities\\Speciality' . "\0" . 'groups'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Speciality $proxy) {
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
    public function getFullName(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFullName', []);

        return parent::getFullName();
    }

    /**
     * {@inheritDoc}
     */
    public function setFullName(string $fullName): \App\Entities\Speciality
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFullName', [$fullName]);

        return parent::setFullName($fullName);
    }

    /**
     * {@inheritDoc}
     */
    public function getAbbreviation(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAbbreviation', []);

        return parent::getAbbreviation();
    }

    /**
     * {@inheritDoc}
     */
    public function setAbbreviation(string $abbreviation): \App\Entities\Speciality
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAbbreviation', [$abbreviation]);

        return parent::setAbbreviation($abbreviation);
    }

    /**
     * {@inheritDoc}
     */
    public function getFaculty(): \App\Entities\Faculty
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFaculty', []);

        return parent::getFaculty();
    }

    /**
     * {@inheritDoc}
     */
    public function setFaculty(\App\Entities\Faculty $faculty): \App\Entities\Speciality
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFaculty', [$faculty]);

        return parent::setFaculty($faculty);
    }

    /**
     * {@inheritDoc}
     */
    public function getGroups(): array
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGroups', []);

        return parent::getGroups();
    }

    /**
     * {@inheritDoc}
     */
    public function getGroupsCollection()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGroupsCollection', []);

        return parent::getGroupsCollection();
    }

    /**
     * {@inheritDoc}
     */
    public function setGroups(array $groups): \App\Entities\Speciality
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGroups', [$groups]);

        return parent::setGroups($groups);
    }

    /**
     * {@inheritDoc}
     */
    public function addGroup(\App\Entities\Group $group): \App\Entities\Speciality
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addGroup', [$group]);

        return parent::addGroup($group);
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