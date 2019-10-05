<?php
namespace App\Repositories;
use App\Constants;
use App\Entities\Department;
use App\Entities\Group;
use App\Entities\Speciality;
use App\Entities\Student;
use App\Entities\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Doctrine\ORM\QueryBuilder;

/**
 * Class StudentRepo
 * @package App\Repositories
 */
class StudentRepo extends EntityRepository {

    /**
     * @var string
     */
    private $class = 'App\Entities\Student';


    /**
     * @param array $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateStudent(array $request)
    {
        $validator = Validator::make($request, [
            "firstName" => "required|max:255",
            "surname" => "required|max:255",
            "middleName" => "required|max:255",
            "studentId" => "required|max:255",
            "gender" => "required|max:255",
            "familyState" => "max:255",
            "familyAddress" => "max:255",
            "addressBegin" => "max:255",
            "beforeNauEdu" => "max:255",
            "beforeNauJob" => "max:255",
            "militaryService" => "max:255",
            "nauConditions" => "max:255",
            "nauContract" => "max:255",
            "nauPrivileges" => "max:255",
            "hostel" => "max:255",
            "additionalInfo" => "max:255"
        ]);

        return $validator;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getStudents(Request $request)
    {
        $results = [];
        $q = $this->findAll();

        /**
         * @var Student $student
         */
        foreach ($q as $student)
        {
            $results[] = $student->getTableArray();
        }
        return $results;
    }

    public function createStudent(array $data, $group, $subjectArr)
    {
        $errors = ["errors" => null];
        $validation = $this->validateStudent($data);
        if(!$validation->fails())
        {
            /**
             * @var Student $group
             */
            $student = new Student();

            if(!empty($subjectArr))
            {
                foreach ($subjectArr as $subject)
                {
                    $student->addAdditionalSubject($subject);
                }
            }
            $today = date('Y-m-d');
            $student->setFirstName($data['firstName']);
            $student->setSurname($data['surname']);
            $student->setMiddleName($data['middleName']);
            $student->setIdNumber($data['studentId']);
            $student->setDateOfBirth($data['dateOfBirth']);
            $student->setGender($data['gender']);
            $student->setCitizenship($data['citizenship']);
            $student->setCreationDate($today);
            $student->setGroup($group);

            if(isset($data['familyState']) && !empty(isset($data['familyState'])))
            {
                $student->setFamilyState($data['familyState']);
            }
            if(isset($data['familyAddress']) && !empty(isset($data['familyAddress'])))
            {
                $student->setMarriageAddress($data['familyAddress']);
            }
            if(isset($data['addressBegin']) && !empty(isset($data['addressBegin'])))
            {
                $student->setAddressUniversityBegin($data['addressBegin']);
            }
            if(isset($data['beforeNauEdu']) && !empty(isset($data['beforeNauEdu'])))
            {
                $student->setBeforeNauEduInfo($data['beforeNauEdu']);
            }
            if(isset($data['beforeNauJob']) && !empty(isset($data['beforeNauJob'])))
            {
                $student->setBeforeNauJobInfo($data['beforeNauJob']);
            }
            if(isset($data['militaryService']) && !empty(isset($data['militaryService'])))
            {
                $student->setMilitaryServiceDates($data['militaryService']);
            }
            if(isset($data['nauConditions']) && !empty(isset($data['nauConditions'])))
            {
                $student->setNauEntryConditionsInfo($data['nauConditions']);
            }
            if(isset($data['nauContract']) && !empty(isset($data['nauContract'])))
            {
                $student->setNauEduContractInfo($data['nauContract']);
            }
            if(isset($data['nauPrivileges']) && !empty(isset($data['nauPrivileges'])))
            {
                $student->setPrivilegesInfo($data['nauPrivileges']);
            }
            if(isset($data['hostel']) && !empty(isset($data['hostel'])))
            {
                $student->setHostelInfo($data['hostel']);
            }
            if(isset($data['additionalInfo']) && !empty(isset($data['additionalInfo'])))
            {
                $student->setAdditionalInfo($data['additionalInfo']);
            }

            $this->_em->persist($student);
            $this->_em->flush();

            return $student;
        }
        $errors["errors"] = $validation->errors()->getMessages();
        return $errors;
    }


    public function editStudent($data,Group $group, $subjectArr)
    {
        $errors = ["errors" => null];
        $validation = $this->validateStudent($data);
        if(!$validation->fails())
        {
            /**
             * @var Student $student
             */
            $student = $this->find($data['id']);
            $student->getAdditionalSubjectsCollection()->clear();

            if(!empty($subjectArr))
            {
                foreach ($subjectArr as $subject)
                {
                    $student->addAdditionalSubject($subject);
                }
            }

            $student->setFirstName($data['firstName']);
            $student->setSurname($data['surname']);
            $student->setMiddleName($data['middleName']);
            $student->setIdNumber($data['studentId']);
            $student->setDateOfBirth($data['dateOfBirth']);
            $student->setGender($data['gender']);
            $student->setCitizenship($data['citizenship']);
            $student->setGroup($group);

            if(isset($data['familyState']) && !empty(isset($data['familyState'])))
            {
                $student->setFamilyState($data['familyState']);
            }
            if(isset($data['familyAddress']) && !empty(isset($data['familyAddress'])))
            {
                $student->setMarriageAddress($data['familyAddress']);
            }
            if(isset($data['addressBegin']) && !empty(isset($data['addressBegin'])))
            {
                $student->setAddressUniversityBegin($data['addressBegin']);
            }
            if(isset($data['beforeNauEdu']) && !empty(isset($data['beforeNauEdu'])))
            {
                $student->setBeforeNauEduInfo($data['beforeNauEdu']);
            }
            if(isset($data['beforeNauJob']) && !empty(isset($data['beforeNauJob'])))
            {
                $student->setBeforeNauJobInfo($data['beforeNauJob']);
            }
            if(isset($data['militaryService']) && !empty(isset($data['militaryService'])))
            {
                $student->setMilitaryServiceDates($data['militaryService']);
            }
            if(isset($data['nauConditions']) && !empty(isset($data['nauConditions'])))
            {
                $student->setNauEntryConditionsInfo($data['nauConditions']);
            }
            if(isset($data['nauContract']) && !empty(isset($data['nauContract'])))
            {
                $student->setNauEduContractInfo($data['nauContract']);
            }
            if(isset($data['nauPrivileges']) && !empty(isset($data['nauPrivileges'])))
            {
                $student->setPrivilegesInfo($data['nauPrivileges']);
            }
            if(isset($data['hostel']) && !empty(isset($data['hostel'])))
            {
                $student->setHostelInfo($data['hostel']);
            }
            if(isset($data['additionalInfo']) && !empty(isset($data['additionalInfo'])))
            {
                $student->setAdditionalInfo($data['additionalInfo']);
            }

            $this->_em->persist($student);
            $this->_em->flush();

            return $student;
        }
        $errors["errors"] = $validation->errors()->getMessages();
        return $errors;
    }


    public function deleteStudents(array $objects)
    {
        $removed = [];
        foreach ($objects as $object){
            $student = $this->find($object['id']);

            if($student instanceof Student)
            {
                $this->_em->remove($student);
                $this->_em->flush();
                $removed[] = $object;
            }else{
                $removed[] = null;
            }
        }
        return $removed;
    }

    /**
     * @param $array
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function removeStudentArray($array)
    {
        if(!empty($array))
        {
            foreach ($array as $student)
            {
                $this->_em->remove($student);
                $this->_em->flush();
            }
        }
    }
}

