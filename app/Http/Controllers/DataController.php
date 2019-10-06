<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Entities\Department;
use App\Entities\Group;
use App\Entities\Speciality;
use App\Entities\Student;
use App\Entities\Subject;
use App\Repositories\FacultyInfoRepo;
use App\Repositories\GroupRepo;
use App\Repositories\SpecialityRepo;
use App\Repositories\StudentRepo;
use App\Repositories\SubjectRepo;
use Doctrine\ORM\EntityManager;
use Illuminate\Http\Request;
use \App\Repositories\DepartmentRepo;

class DataController extends Controller
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var string
     */
    private $department = "App\Entities\Department";

    /**
     * @var DepartmentRepo
     */
    private $repoDepartments;

    /**
     * @var string
     */
    private $speciality = "App\Entities\Speciality";

    /**
     * @var SpecialityRepo
     */
    private $repoSpeciality;

    /**
     * @var string
     */
    private $subject = "App\Entities\Subject";

    /**
     * @var SubjectRepo
     */
    private $repoSubjects;

    /**
     * @var GroupRepo
     */
    private $repoGroup;

    /**
     * @var string
     */
    private $group = "App\Entities\Group";

    /**
     * @var StudentRepo
     */
    private $repoStudent;

    /**
     * @var string
     */
    private $student = "App\Entities\Student";

    /**
     * @var FacultyInfoRepo
     */
    private $repoFacultyInfo;

    /**
     * @var string
     */
    private $facultyInfo = "App\Entities\FacultyInfo";

    /**
     * DataController constructor.
     * @param $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

        $this->repoDepartments = $this->entityManager->getRepository($this->department);
        $this->repoSpeciality = $this->entityManager->getRepository($this->speciality);
        $this->repoSubjects = $this->entityManager->getRepository($this->subject);
        $this->repoGroup = $this->entityManager->getRepository($this->group);
        $this->repoStudent = $this->entityManager->getRepository($this->student);
        $this->repoFacultyInfo = $this->entityManager->getRepository($this->facultyInfo);
    }

    public function getF(Request $request)
    {
        $fs = $this->repoDepartments->findAll();
        $ar = [];
        foreach ($fs as $dep)
        {
            $ar[$dep->getFullName()] = [];
            $sArr = $dep->getSpecialities();
            foreach ($sArr as $item)
            {
                $ar[$dep->getFullName()][] = $item->getTableArray();
            }
        }
        return $ar;
    }

    /**
     * @param array $data
     * @param array $required
     * @return bool
     */
    public function hasRequired(array $data,array $required)
    {
        foreach ($required as $field)
        {
            if(!isset($data[$field]) || empty($data[$field]))
            {
                return false;
            }
        }
        return true;
    }


    public function updateFacultyInfo(Request $request)
    {
        if($request->session()->all()['isAdmin'])
        {
           return $this->repoFacultyInfo->updateFacultyInfo($request->all());
        }
        return response()->json(Constants::OPERATION_SUPER_FAILED, 400);
    }

    public function getFacultyInfo(Request $request)
    {
        return $this->repoFacultyInfo->getFacultyInfo();
    }


//    public function getFacultyData(Request $request)
//    {
//        $data = $this->repoFaculties->findAll();
//
//        $tableData = [
//            "draw" => 10,
//            "recordsTotal" => count($data),
//            "recordsFiltered" => count($data),
//            "data" => []
//        ];
//        foreach ($data as $record) {
//
//            $tableData["data"][] = $record->getTableArray();
//        }
//
//        return $tableData;
//    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function getDepartmentData(Request $request)
    {
       return $this->repoDepartments->getDepartments($request);
    }


    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createDepartment(Request $request)
    {
        $data = $request->all();
        $department = $this->repoDepartments->createDepartment($data);
        if($department instanceof Department){
            return $department->getTableArray();
        }else{
            return response()->json(array_merge(Constants::OPERATION_FAILED,$department), 400);
        }
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteDepartments(Request $request)
    {
        $data = $request->all();
        if(isset($data['objects']) && !empty($data['objects']))
        {
            foreach ($data['objects'] as $dep){
                /**
                 * @var Department $department
                 */
                $department = $this->repoDepartments->find($dep['id']);
                if($department instanceof Department)
                {
                    $specialities = $department->getSpecialities();
                    $this->repoSpeciality->removeSpecialityArray($specialities);
                    /**
                     * @var Speciality $speciality
                     */
                    foreach ($specialities as $speciality)
                    {
                        $this->repoGroup->removeGroupArray($speciality->getGroupsCollection());
                    }
                }
            }

            return $this->repoDepartments->deleteDepartments($data['objects']);
        }
        return Constants::OPERATION_FAILED;
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editDepartment(Request $request)
    {
        $data = $request->all();
        $department = $this->repoDepartments->editDepartment($data);
        if($department instanceof Department){
            return $department->getTableArray();
        }else{
            return response()->json(array_merge(Constants::OPERATION_FAILED,$department), 400);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getSpecialityData(Request $request)
    {
        return $this->repoSpeciality->getSpecialities($request);
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createSpeciality(Request $request)
    {
        $data = $request->all();
        $speciality = [];

        $department = $this->repoDepartments->find($data['department']);
        if($department instanceof Department)
        {
            $speciality = $this->repoSpeciality->createSpeciality($data, $department);
            if($speciality instanceof Speciality){
                $department->addSpeciality($speciality);
                $this->repoDepartments->updateDepartment($department);

                return $speciality->getTableArray();
            }
        }

        return response()->json(array_merge(Constants::OPERATION_FAILED,$speciality), 400);
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteSpecialities(Request $request)
    {
        $data = $request->all();

        if(isset($data['objects']) && !empty($data['objects']))
        {
            /**
             * @var Speciality $speciality
             */
            foreach ($data['objects'] as $speciality)
            {
                $department = $this->repoDepartments->find($speciality['department']['id']);
                $s = $this->repoSpeciality->find($speciality['id']);
                if($department instanceof Department && $s instanceof Speciality)
                {
                    $department->getSpecialitiesCollection()->removeElement($s);
                    $this->repoDepartments->updateDepartment($department);
                }

                $groups = $speciality->getGroupsCollection();
                $this->repoGroup->removeGroupArray($groups);
            }

            return $this->repoSpeciality->deleteSpecialities($data['objects']);
        }
        return Constants::OPERATION_FAILED;
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editSpeciality(Request $request)
    {
        $data = $request->all();
        $speciality = [];


        $department = $this->repoDepartments->find($data['department']);

        if($department instanceof Department)
        {
            $speciality = $this->repoSpeciality->find($data['id']);

            if($speciality instanceof Speciality)
            {
                if($department->getId() != $speciality->getDepartment()->getId())
                {
                    $oldDep = $speciality->getDepartment();
                    $oldDep->getSpecialitiesCollection()->removeElement($speciality);
                    $department->addSpeciality($speciality);
                    $this->repoDepartments->updateDepartment($oldDep);
                    $this->repoDepartments->updateDepartment($department);
                }
            }

            $speciality = $this->repoSpeciality->editSpeciality($data, $department);
        }

        if($speciality instanceof Speciality){
            return $speciality->getTableArray();
        }else{
            return response()->json(array_merge(Constants::OPERATION_FAILED,$speciality), 400);
        }
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function getSubjectData(Request $request)
    {
        return $this->repoSubjects->getSubjects($request);
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createSubject(Request $request)
    {
        $data = $request->all();
        $subject = $this->repoSubjects->createSubject($data);
        if($subject instanceof Subject){
            return $subject->getTableArray();
        }else{
            return response()->json(array_merge(Constants::OPERATION_FAILED,$subject), 400);
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function deleteSubjects(Request $request)
    {
        $data = $request->all();
        if(isset($data['objects']) && !empty($data['objects']))
        {
            return $this->repoSubjects->deleteSubjects($data['objects']);
        }
        return Constants::OPERATION_FAILED;
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editSubject(Request $request)
    {
        $data = $request->all();
        $subject = $this->repoSubjects->editSubject($data);
        if($subject instanceof Subject){
            return $subject->getTableArray();
        }else{
            return response()->json(array_merge(Constants::OPERATION_FAILED,$subject), 400);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getGroupData(Request $request)
    {
        return $this->repoGroup->getGroups($request);
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function createGroup(Request $request)
    {
        $data = $request->all();
        $group = [];
        $subjects = [];

        if(isset($data['defaultSubjects']) && !empty($data['defaultSubjects']))
        {
            foreach ($data['defaultSubjects'] as $subj)
            {
                if(!is_null($subj))
                {
                    $subjects[] = $this->repoSubjects->find($subj);
                }
            }
        }

        $speciality = $this->repoSpeciality->find($data['speciality']);

        if($speciality instanceof Speciality)
        {
            $group = $this->repoGroup->createGroup($data, $speciality,$subjects);
            if($group instanceof Group){
                $speciality->addGroup($group);
                $this->repoSpeciality->updateSpeciality($speciality);
                return $group->getTableArray();
            }
        }

        return response()->json(array_merge(Constants::OPERATION_FAILED,$group), 400);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function deleteGroups(Request $request)
    {
        $data = $request->all();

        if(isset($data['objects']) && !empty($data['objects']))
        {
            foreach ($data['objects'] as $group)
            {
                $speciality = $this->repoSpeciality->find($group['speciality']);
                $g = $this->repoGroup->find($group['id']);
                if($speciality instanceof Speciality && $g instanceof Group)
                {
                    $speciality->getGroupsCollection()->removeElement($g);
                    $this->repoSpeciality->updateSpeciality($speciality);
                }
            }

            return $this->repoGroup->deleteGroups($data['objects']);
        }
        return Constants::OPERATION_FAILED;
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function editGroup(Request $request)
    {
        $data = $request->all();
        $subjects = [];

        if(isset($data['defaultSubjects']) && !empty($data['defaultSubjects']))
        {
            foreach ($data['defaultSubjects'] as $subj)
            {
                if(!is_null($subj))
                {
                    $subjects[] = $this->repoSubjects->find($subj);
                }
            }
        }

        $speciality = $this->repoSpeciality->find($data['speciality']);
        $group = $this->repoGroup->find($data['id']);
        if($speciality instanceof Speciality && $group instanceof Group)
        {
            if($speciality->getId() != $group->getSpeciality()->getId())
            {
                /**
                 * @var Speciality $oldSpec
                 */
                $oldSpec = $group->getSpeciality();
                $oldSpec->getGroupsCollection()->removeElement($group);
                $speciality->addGroup($group);
                $this->repoSpeciality->updateSpeciality($oldSpec);
                $this->repoSpeciality->updateSpeciality($speciality);
            }

            $group = $this->repoGroup->editGroup($data, $speciality, $subjects);

            if($group instanceof Group)
            {
                return $group->getTableArray();
            }
        }

        return response()->json(array_merge(Constants::OPERATION_FAILED,$group), 400);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getStudentData(Request $request)
    {
        return $this->repoStudent->getStudents($request);
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function createStudent(Request $request)
    {
        $data = $request->all();
        $student = [];
        $subjects = [];
        $group = null;

        if(isset($data['additionalSubjects']) && !empty($data['additionalSubjects']))
        {
            foreach ($data['additionalSubjects'] as $subj)
            {
                if(!is_null($subj))
                {
                    $subjects[] = $this->repoSubjects->find($subj);
                }
            }
        }

        if(isset($data['group']) && !empty($data['group'])){
            $group = $this->repoGroup->find($data['group']);
        }

        $student = $this->repoStudent->createStudent($data, $group, $subjects);
        if($student instanceof Student){
            if($group instanceof Group)
            {
                $group->addStudent($student);
                $this->repoGroup->updateGroup($group);
                return $student->getTableArray();
            }
        }

        return response()->json(array_merge(Constants::OPERATION_FAILED,$student), 400);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function deleteStudents(Request $request)
    {
        $data = $request->all();

        if(isset($data['objects']) && !empty($data['objects']))
        {
            foreach ($data['objects'] as $student)
            {
                $group = $this->repoGroup->find($student['group']);
                $s = $this->repoStudent->find($student['id']);
                if($group instanceof Group && $s instanceof Student)
                {
                    $group->getStudentsCollection()->removeElement($s);
                    $this->repoGroup->updateGroup($group);
                }
            }

            return $this->repoStudent->deleteStudents($data['objects']);
        }
        return Constants::OPERATION_FAILED;
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function editStudent(Request $request)
    {
        $data = $request->all();
        $subjects = [];

        if(isset($data['additionalSubjects']) && !empty($data['additionalSubjects']))
        {
            foreach ($data['additionalSubjects'] as $subj)
            {
                if(!is_null($subj))
                {
                    $subjects[] = $this->repoSubjects->find($subj);
                }
            }
        }

        $group = $this->repoGroup->find($data['group']);
        $student = $this->repoStudent->find($data['id']);
        if($group instanceof Group && $student instanceof Student)
        {
            if($group->getId() != $student->getGroup()->getId())
            {
                /**
                 * @var Group $oldGroup
                 */
                $oldGroup = $student->getGroup();
                $oldGroup->getStudentsCollection()->removeElement($student);
                $group->addStudent($student);
                $this->repoGroup->updateGroup($oldGroup);
                $this->repoGroup->updateGroup($group);
            }

            $student = $this->repoStudent->editStudent($data, $group, $subjects);

            if($student instanceof Student)
            {
                return $student->getTableArray();
            }
        }

        return response()->json(array_merge(Constants::OPERATION_FAILED,$student), 400);
    }

    public function getSubjectsByGroup($id)
    {
        $group = $this->repoGroup->find($id);
        if($group instanceof Group)
        {
            return $group->getTableArray();
        }
    }
    public function getStudentsByGroup($group_id)
    {
        $students = $this->repoStudent->findAll();
        $arrStudents = [];
        /**
         * @var Student $student
         */
        foreach ($students as $student)
        {
            if($student->getGroup()->getId() == $group_id)
            {
                $arrStudents[] = $student->getTableArray();
            }
        }
        return $arrStudents;
    }
}
