<?php

namespace DoctrineProxies\__CG__\App\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Theme extends \App\Entities\Theme implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'App\\Entities\\Theme' . "\0" . 'id', '' . "\0" . 'App\\Entities\\Theme' . "\0" . 'mainBGcolor', '' . "\0" . 'App\\Entities\\Theme' . "\0" . 'secondBGcolor', '' . "\0" . 'App\\Entities\\Theme' . "\0" . 'navbarBGcolor', '' . "\0" . 'App\\Entities\\Theme' . "\0" . 'primaryBGcolor', '' . "\0" . 'App\\Entities\\Theme' . "\0" . 'secondBGcolorTransparency', '' . "\0" . 'App\\Entities\\Theme' . "\0" . 'navbarBGcolorTransparency', '' . "\0" . 'App\\Entities\\Theme' . "\0" . 'primaryBGcolorTransparency'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Entities\\Theme' . "\0" . 'id', '' . "\0" . 'App\\Entities\\Theme' . "\0" . 'mainBGcolor', '' . "\0" . 'App\\Entities\\Theme' . "\0" . 'secondBGcolor', '' . "\0" . 'App\\Entities\\Theme' . "\0" . 'navbarBGcolor', '' . "\0" . 'App\\Entities\\Theme' . "\0" . 'primaryBGcolor', '' . "\0" . 'App\\Entities\\Theme' . "\0" . 'secondBGcolorTransparency', '' . "\0" . 'App\\Entities\\Theme' . "\0" . 'navbarBGcolorTransparency', '' . "\0" . 'App\\Entities\\Theme' . "\0" . 'primaryBGcolorTransparency'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Theme $proxy) {
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
    public function getId()
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
    public function getMainBGcolor()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMainBGcolor', []);

        return parent::getMainBGcolor();
    }

    /**
     * {@inheritDoc}
     */
    public function setMainBGcolor($mainBGcolor)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMainBGcolor', [$mainBGcolor]);

        return parent::setMainBGcolor($mainBGcolor);
    }

    /**
     * {@inheritDoc}
     */
    public function getSecondBGcolor()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSecondBGcolor', []);

        return parent::getSecondBGcolor();
    }

    /**
     * {@inheritDoc}
     */
    public function setSecondBGcolor($secondBGcolor)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSecondBGcolor', [$secondBGcolor]);

        return parent::setSecondBGcolor($secondBGcolor);
    }

    /**
     * {@inheritDoc}
     */
    public function getNavbarBGcolor()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNavbarBGcolor', []);

        return parent::getNavbarBGcolor();
    }

    /**
     * {@inheritDoc}
     */
    public function setNavbarBGcolor($navbarBGcolor)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNavbarBGcolor', [$navbarBGcolor]);

        return parent::setNavbarBGcolor($navbarBGcolor);
    }

    /**
     * {@inheritDoc}
     */
    public function getPrimaryBGcolor()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPrimaryBGcolor', []);

        return parent::getPrimaryBGcolor();
    }

    /**
     * {@inheritDoc}
     */
    public function setPrimaryBGcolor($primaryBGcolor)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPrimaryBGcolor', [$primaryBGcolor]);

        return parent::setPrimaryBGcolor($primaryBGcolor);
    }

    /**
     * {@inheritDoc}
     */
    public function getSecondBGcolorTransparency()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSecondBGcolorTransparency', []);

        return parent::getSecondBGcolorTransparency();
    }

    /**
     * {@inheritDoc}
     */
    public function setSecondBGcolorTransparency($secondBGcolorTransparency)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSecondBGcolorTransparency', [$secondBGcolorTransparency]);

        return parent::setSecondBGcolorTransparency($secondBGcolorTransparency);
    }

    /**
     * {@inheritDoc}
     */
    public function getNavbarBGcolorTransparency()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNavbarBGcolorTransparency', []);

        return parent::getNavbarBGcolorTransparency();
    }

    /**
     * {@inheritDoc}
     */
    public function setNavbarBGcolorTransparency($navbarBGcolorTransparency)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNavbarBGcolorTransparency', [$navbarBGcolorTransparency]);

        return parent::setNavbarBGcolorTransparency($navbarBGcolorTransparency);
    }

    /**
     * {@inheritDoc}
     */
    public function getPrimaryBGcolorTransparency()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPrimaryBGcolorTransparency', []);

        return parent::getPrimaryBGcolorTransparency();
    }

    /**
     * {@inheritDoc}
     */
    public function setPrimaryBGcolorTransparency($primaryBGcolorTransparency)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPrimaryBGcolorTransparency', [$primaryBGcolorTransparency]);

        return parent::setPrimaryBGcolorTransparency($primaryBGcolorTransparency);
    }

    /**
     * {@inheritDoc}
     */
    public function getArrayData(): array
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArrayData', []);

        return parent::getArrayData();
    }

}
