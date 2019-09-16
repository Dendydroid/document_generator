<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Entities\Faculty;
use App\Entities\Group;
use App\Entities\Speciality;
use App\Entities\Student;
use App\Entities\Subject;
use App\Repositories\GroupRepo;
use App\Repositories\InstituteRepo;
use App\Repositories\SpecialityRepo;
use App\Repositories\StudentRepo;
use App\Repositories\SubjectRepo;
use Doctrine\ORM\EntityManager;
use Illuminate\Http\Request;
use \App\Repositories\FacultyRepo;

class DataController extends Controller
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var string
     */
    private $faculty = "App\Entities\Faculty";

    /**
     * @var FacultyRepo
     */
    private $repoFaculties;

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
     * DataController constructor.
     * @param $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

        $this->repoFaculties = $this->entityManager->getRepository($this->faculty);
        $this->repoSpeciality = $this->entityManager->getRepository($this->speciality);
        $this->repoSubjects = $this->entityManager->getRepository($this->subject);
        $this->repoGroup = $this->entityManager->getRepository($this->group);
        $this->repoStudent = $this->entityManager->getRepository($this->student);
    }

    public function getF(Request $request)
    {
        $fs = $this->repoFaculties->findAll();
        $ar = [];
        foreach ($fs as $fac)
        {
            $ar[$fac->getFullName()] = [];
            $sArr = $fac->getSpecialities();
            foreach ($sArr as $item)
            {
                $ar[$fac->getFullName()][] = $item->getTableArray();
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
    public function getFacultyData(Request $request)
    {
       return $this->repoFaculties->getFaculties($request);
    }


    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createFaculty(Request $request)
    {
        $data = $request->all();
        $faculty = $this->repoFaculties->createFaculty($data);
        if($faculty instanceof Faculty){
            return $faculty->getTableArray();
        }else{
            return response()->json(array_merge(Constants::OPERATION_FAILED,$faculty), 400);
        }
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteFaculties(Request $request)
    {
        $data = $request->all();
        if(isset($data['objects']) && !empty($data['objects']))
        {
            foreach ($data['objects'] as $fac){
                /**
                 * @var Faculty $faculty
                 */
                $faculty = $this->repoFaculties->find($fac['id']);
                if($faculty instanceof Faculty)
                {
                    $specialities = $faculty->getSpecialities();
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

            return $this->repoFaculties->deleteFaculties($data['objects']);
        }
        return Constants::OPERATION_FAILED;
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editFaculty(Request $request)
    {
        $data = $request->all();
        $faculty = $this->repoFaculties->editFaculty($data);
        if($faculty instanceof Faculty){
            return $faculty->getTableArray();
        }else{
            return response()->json(array_merge(Constants::OPERATION_FAILED,$faculty), 400);
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

        $faculty = $this->repoFaculties->find($data['faculty']);
        if($faculty instanceof Faculty)
        {
            $speciality = $this->repoSpeciality->createSpeciality($data, $faculty);
            if($speciality instanceof Speciality){
                $faculty->addSpeciality($speciality);
                $this->repoFaculties->updateFaculty($faculty);

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
                $faculty = $this->repoFaculties->find($speciality['faculty']['id']);
                $s = $this->repoSpeciality->find($speciality['id']);
                if($faculty instanceof Faculty && $s instanceof Speciality)
                {
                    $faculty->getSpecialitiesCollection()->removeElement($s);
                    $this->repoFaculties->updateFaculty($faculty);
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


        $faculty = $this->repoFaculties->find($data['faculty']);

        if($faculty instanceof Faculty)
        {
            $speciality = $this->repoSpeciality->find($data['id']);

            if($speciality instanceof Speciality)
            {
                if($faculty->getId() != $speciality->getFaculty()->getId())
                {
                    $oldFac = $speciality->getFaculty();
                    $oldFac->getSpecialitiesCollection()->removeElement($speciality);
                    $faculty->addSpeciality($speciality);
                    $this->repoFaculties->updateFaculty($oldFac);
                    $this->repoFaculties->updateFaculty($faculty);
                }
            }

            $speciality = $this->repoSpeciality->editSpeciality($data, $faculty);
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
}
