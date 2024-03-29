<?php

namespace DoctrineProxies\__CG__\App\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Student extends \App\Entities\Student implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'id', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'firstName', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'surname', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'middleName', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'idNumber', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'dateOfBirth', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'citizenship', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'gender', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'familyState', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'marriageAddress', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'addressUniversityBegin', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'beforeNauEduInfo', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'beforeNauJobInfo', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'militaryServiceDates', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'nauEntryConditionsInfo', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'nauEduContractInfo', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'privilegesInfo', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'hostelInfo', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'additionalInfo', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'creationDate', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'preparationAbbrev', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'specialityAbbrev', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'specializationInfo', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'encouragementPenaltyList', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'parents', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'otherOrderList', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'group'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'id', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'firstName', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'surname', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'middleName', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'idNumber', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'dateOfBirth', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'citizenship', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'gender', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'familyState', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'marriageAddress', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'addressUniversityBegin', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'beforeNauEduInfo', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'beforeNauJobInfo', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'militaryServiceDates', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'nauEntryConditionsInfo', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'nauEduContractInfo', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'privilegesInfo', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'hostelInfo', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'additionalInfo', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'creationDate', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'preparationAbbrev', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'specialityAbbrev', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'specializationInfo', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'encouragementPenaltyList', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'parents', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'otherOrderList', '' . "\0" . 'App\\Entities\\Student' . "\0" . 'group'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Student $proxy) {
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
    public function getFirstName(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFirstName', []);

        return parent::getFirstName();
    }

    /**
     * {@inheritDoc}
     */
    public function setFirstName(string $firstName): \App\Entities\Student
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
    public function setSurname(string $surname): \App\Entities\Student
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
    public function setMiddleName(string $middleName): \App\Entities\Student
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMiddleName', [$middleName]);

        return parent::setMiddleName($middleName);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdNumber(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdNumber', []);

        return parent::getIdNumber();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdNumber(string $idNumber): \App\Entities\Student
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdNumber', [$idNumber]);

        return parent::setIdNumber($idNumber);
    }

    /**
     * {@inheritDoc}
     */
    public function getDateOfBirth(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDateOfBirth', []);

        return parent::getDateOfBirth();
    }

    /**
     * {@inheritDoc}
     */
    public function setDateOfBirth(string $dateOfBirth): \App\Entities\Student
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDateOfBirth', [$dateOfBirth]);

        return parent::setDateOfBirth($dateOfBirth);
    }

    /**
     * {@inheritDoc}
     */
    public function getCitizenship(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCitizenship', []);

        return parent::getCitizenship();
    }

    /**
     * {@inheritDoc}
     */
    public function setCitizenship(string $citizenship): \App\Entities\Student
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCitizenship', [$citizenship]);

        return parent::setCitizenship($citizenship);
    }

    /**
     * {@inheritDoc}
     */
    public function getGender(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGender', []);

        return parent::getGender();
    }

    /**
     * {@inheritDoc}
     */
    public function setGender(string $gender): \App\Entities\Student
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGender', [$gender]);

        return parent::setGender($gender);
    }

    /**
     * {@inheritDoc}
     */
    public function getFamilyState(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFamilyState', []);

        return parent::getFamilyState();
    }

    /**
     * {@inheritDoc}
     */
    public function setFamilyState(string $familyState): \App\Entities\Student
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFamilyState', [$familyState]);

        return parent::setFamilyState($familyState);
    }

    /**
     * {@inheritDoc}
     */
    public function getMarriageAddress(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMarriageAddress', []);

        return parent::getMarriageAddress();
    }

    /**
     * {@inheritDoc}
     */
    public function setMarriageAddress(string $marriageAddress): \App\Entities\Student
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMarriageAddress', [$marriageAddress]);

        return parent::setMarriageAddress($marriageAddress);
    }

    /**
     * {@inheritDoc}
     */
    public function getAddressUniversityBegin(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAddressUniversityBegin', []);

        return parent::getAddressUniversityBegin();
    }

    /**
     * {@inheritDoc}
     */
    public function setAddressUniversityBegin(string $addressUniversityBegin): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAddressUniversityBegin', [$addressUniversityBegin]);

        return parent::setAddressUniversityBegin($addressUniversityBegin);
    }

    /**
     * {@inheritDoc}
     */
    public function getBeforeNauEduInfo(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBeforeNauEduInfo', []);

        return parent::getBeforeNauEduInfo();
    }

    /**
     * {@inheritDoc}
     */
    public function setBeforeNauEduInfo(string $beforeNauEduInfo): \App\Entities\Student
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBeforeNauEduInfo', [$beforeNauEduInfo]);

        return parent::setBeforeNauEduInfo($beforeNauEduInfo);
    }

    /**
     * {@inheritDoc}
     */
    public function getBeforeNauJobInfo(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBeforeNauJobInfo', []);

        return parent::getBeforeNauJobInfo();
    }

    /**
     * {@inheritDoc}
     */
    public function setBeforeNauJobInfo(string $beforeNauJobInfo): \App\Entities\Student
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBeforeNauJobInfo', [$beforeNauJobInfo]);

        return parent::setBeforeNauJobInfo($beforeNauJobInfo);
    }

    /**
     * {@inheritDoc}
     */
    public function getMilitaryServiceDates(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMilitaryServiceDates', []);

        return parent::getMilitaryServiceDates();
    }

    /**
     * {@inheritDoc}
     */
    public function setMilitaryServiceDates(string $militaryServiceDates): \App\Entities\Student
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMilitaryServiceDates', [$militaryServiceDates]);

        return parent::setMilitaryServiceDates($militaryServiceDates);
    }

    /**
     * {@inheritDoc}
     */
    public function getNauEntryConditionsInfo(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNauEntryConditionsInfo', []);

        return parent::getNauEntryConditionsInfo();
    }

    /**
     * {@inheritDoc}
     */
    public function setNauEntryConditionsInfo(string $nauEntryConditionsInfo): \App\Entities\Student
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNauEntryConditionsInfo', [$nauEntryConditionsInfo]);

        return parent::setNauEntryConditionsInfo($nauEntryConditionsInfo);
    }

    /**
     * {@inheritDoc}
     */
    public function getNauEduContractInfo(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNauEduContractInfo', []);

        return parent::getNauEduContractInfo();
    }

    /**
     * {@inheritDoc}
     */
    public function setNauEduContractInfo(string $nauEduContractInfo): \App\Entities\Student
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNauEduContractInfo', [$nauEduContractInfo]);

        return parent::setNauEduContractInfo($nauEduContractInfo);
    }

    /**
     * {@inheritDoc}
     */
    public function getPrivilegesInfo(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPrivilegesInfo', []);

        return parent::getPrivilegesInfo();
    }

    /**
     * {@inheritDoc}
     */
    public function setPrivilegesInfo(string $privilegesInfo): \App\Entities\Student
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPrivilegesInfo', [$privilegesInfo]);

        return parent::setPrivilegesInfo($privilegesInfo);
    }

    /**
     * {@inheritDoc}
     */
    public function getHostelInfo(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHostelInfo', []);

        return parent::getHostelInfo();
    }

    /**
     * {@inheritDoc}
     */
    public function setHostelInfo(string $hostelInfo): \App\Entities\Student
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHostelInfo', [$hostelInfo]);

        return parent::setHostelInfo($hostelInfo);
    }

    /**
     * {@inheritDoc}
     */
    public function getAdditionalInfo(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAdditionalInfo', []);

        return parent::getAdditionalInfo();
    }

    /**
     * {@inheritDoc}
     */
    public function setAdditionalInfo(string $additionalInfo): \App\Entities\Student
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAdditionalInfo', [$additionalInfo]);

        return parent::setAdditionalInfo($additionalInfo);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreationDate(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreationDate', []);

        return parent::getCreationDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreationDate(string $creationDate): \App\Entities\Student
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreationDate', [$creationDate]);

        return parent::setCreationDate($creationDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getPreparationAbbrev(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPreparationAbbrev', []);

        return parent::getPreparationAbbrev();
    }

    /**
     * {@inheritDoc}
     */
    public function setPreparationAbbrev(string $preparationAbbrev): \App\Entities\Student
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPreparationAbbrev', [$preparationAbbrev]);

        return parent::setPreparationAbbrev($preparationAbbrev);
    }

    /**
     * {@inheritDoc}
     */
    public function getSpecialityAbbrev(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSpecialityAbbrev', []);

        return parent::getSpecialityAbbrev();
    }

    /**
     * {@inheritDoc}
     */
    public function setSpecialityAbbrev(string $specialityAbbrev): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSpecialityAbbrev', [$specialityAbbrev]);

        return parent::setSpecialityAbbrev($specialityAbbrev);
    }

    /**
     * {@inheritDoc}
     */
    public function getSpecializationInfo(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSpecializationInfo', []);

        return parent::getSpecializationInfo();
    }

    /**
     * {@inheritDoc}
     */
    public function setSpecializationInfo(string $specializationInfo): \App\Entities\Student
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSpecializationInfo', [$specializationInfo]);

        return parent::setSpecializationInfo($specializationInfo);
    }

    /**
     * {@inheritDoc}
     */
    public function getEncouragementPenaltyList(): array
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEncouragementPenaltyList', []);

        return parent::getEncouragementPenaltyList();
    }

    /**
     * {@inheritDoc}
     */
    public function setEncouragementPenaltyList(array $encouragementPenaltyList): \App\Entities\Student
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEncouragementPenaltyList', [$encouragementPenaltyList]);

        return parent::setEncouragementPenaltyList($encouragementPenaltyList);
    }

    /**
     * {@inheritDoc}
     */
    public function getParents(): array
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getParents', []);

        return parent::getParents();
    }

    /**
     * {@inheritDoc}
     */
    public function setParents(array $parents): \App\Entities\Student
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setParents', [$parents]);

        return parent::setParents($parents);
    }

    /**
     * {@inheritDoc}
     */
    public function getOtherOrderList(): array
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOtherOrderList', []);

        return parent::getOtherOrderList();
    }

    /**
     * {@inheritDoc}
     */
    public function setOtherOrderList(array $otherOrderList): \App\Entities\Student
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOtherOrderList', [$otherOrderList]);

        return parent::setOtherOrderList($otherOrderList);
    }

    /**
     * {@inheritDoc}
     */
    public function getGroup(): \App\Entities\Group
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGroup', []);

        return parent::getGroup();
    }

    /**
     * {@inheritDoc}
     */
    public function setGroup(\App\Entities\Group $group): \App\Entities\Student
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGroup', [$group]);

        return parent::setGroup($group);
    }

}
