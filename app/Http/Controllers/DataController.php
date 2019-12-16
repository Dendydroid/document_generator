<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Entities\Department;
use App\Entities\Group;
use App\Entities\Speciality;
use App\Entities\Student;
use App\Entities\Subject;
use App\Entities\User;
use App\Repositories\FacultyInfoRepo;
use App\Repositories\GroupDisciplineMarksRepo;
use App\Repositories\GroupRepo;
use App\Repositories\SpecialityRepo;
use App\Repositories\StudentRepo;
use App\Repositories\SubjectRepo;
use App\Repositories\TeacherTokenRepo;
use App\Repositories\UserRepo;
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
     * @var GroupDisciplineMarksRepo
     */
    private $repoGroupDiscipline;

    /**
     * @var string
     */
    private $groupDiscipline = "App\Entities\GroupDisciplineMarks";

    /**
     * @var UserRepo
     */
    private $repoUser;

    /**
     * @var string
     */
    private $user = "App\Entities\User";

    /**
     * @var TeacherTokenRepo
     */
    private $repoTeacherToken;

    /**
     * @var string
     */
    private $teacherToken = "App\Entities\TeacherToken";

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
        $this->repoGroupDiscipline = $this->entityManager->getRepository($this->groupDiscipline);
        $this->repoUser = $this->entityManager->getRepository($this->user);
        $this->repoTeacherToken = $this->entityManager->getRepository($this->teacherToken);
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

    public function charIsNumber($ch)
    {
        return $ch[0] >= "0" && $ch[0] <= "9";

    }

    public function csvGetOtherData($fileText)
    {
        $specialityName = trim(str_replace(";","",substr($fileText,strpos($fileText," ")+1, strpos($fileText,";"))));
        $specialityCode = trim(substr($fileText,0, strpos($fileText," ")));

        $save = false;
        $opp = "";
        $lineCount = 0;

        for($i=0;$i<strlen($fileText);$i++)
        {
            if($fileText[$i] === "\n")
            {
                $lineCount++;
            }
            if($lineCount == 1){
                $save = true;
            }
            if($save && $fileText[$i] == ";")
            {
                break;
            }
            if($save)
            {
                $opp.= $fileText[$i];
            }
        }
        $groupName = "";
        $save = false;
        for($i=0;$i<strlen($fileText);$i++)
        {
            if($fileText[$i] === "\n")
            {
                $lineCount++;
            }
            if($lineCount == 3){
                $save = true;
            }
            if($save && $fileText[$i] == ";")
            {
                break;
            }
            if($save)
            {
                $groupName.= $fileText[$i];
            }
        }
        $groupName = trim(str_replace("\n","",$groupName));
        $opp = str_replace("ОПП ", "", $opp);
        $opp = trim(str_replace("\n", "", $opp));
        $result = [
            "specialityName"=>$specialityName,
            "opp" => $opp,
            "groupName" => $groupName,
            "specialityCode" => $specialityCode
        ];
        return $result;
    }

    public function getCSVHeaders($str)
    {
        $save = false;
        $temp = "";
        $lineCount = 0;
        for($i=0;$i<strlen($str);$i++)
        {
            if($str[$i] === "\n")
            {
                $lineCount++;
            }
            if($save && $str[$i] == "\n")
            {
                $save = false;
            }
            if($lineCount == 3){
                $save = true;
            }
            if($save && !($str[$i] >= "0" && $str[$i] <= "9"))
            {
                $temp.= $str[$i];
            }
        }
        $temp = str_replace(";;",";", $temp);
        return $temp;
    }


    function multiExplode ($delimiters,$string) {

        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }

    public function uploadCsv(Request $request)
    {
        if($request->get('chosen_department'))
            $departmentName = $request->get('chosen_department');
        else
            return "Пожалуйста, выберите кафедру";

       $depArr = $this->multiExplode([" ","-"], $departmentName);

       $depAbbrev = "";

       $studentsArr = [];

       foreach($depArr as $word)
       {
           $depAbbrev.=mb_substr($word,0,1);
       }

       $depAbbrev = mb_strtoupper($depAbbrev);

       $department = $this->repoDepartments->findOneBy(["fullName" => $departmentName]);


       if(!($department instanceof Department))
       {
         $department = $this->repoDepartments->createDepartment([
            "fullName" => $departmentName,
            "abbreviation" => $depAbbrev,
            "head" => ""
         ]);
       }
       $files = $request->all()['upload'];
        foreach ($files as $file) {
            $fileText = $file->get();
            $temp = "";
            $collect = false;
            $headers = $this->getCSVHeaders($fileText);
            for($i=0;$i<strlen($fileText);$i++)
            {
                if($collect && $fileText[$i] == "\n")
                {
                    $temp.="\n";
                    $collect = false;
                }
                if($fileText[$i] == "\n" && isset($fileText[$i+1]) && $this->charIsNumber($fileText[$i+1]))
                {
                    $collect = true;
                }
                if($collect)
                {
                    $temp.=$fileText[$i];
                }
            }
            $rows = explode("\n\n", $headers . "\n" . $temp);
            $keys = array_slice($rows,0,1);
            $keys = preg_split('@;@', str_replace("\n", "", $keys[0]), NULL, PREG_SPLIT_NO_EMPTY);



            for($line = 1; $line < count($rows); $line++)
            {
                $student = explode(";",$rows[$line]);
                for($k = 0; $k < count($keys);$k++)
                {
                    $studentsArr[$line-1][trim($keys[$k])] = trim($student[$k]);
                }
            }

            $numberKey = $keys[0];

            $otherData = $this->csvGetOtherData($fileText);

           $specArr = $this->multiExplode([" ","-"], $otherData['specialityName']);

           $abbrev = "";

           foreach($specArr as $word)
           {
               $abbrev.=mb_substr($word,0,1);
           }

           $specialityAbbrev = mb_strtoupper($abbrev);

           $speciality = $this->repoSpeciality->findOneBy(["fullName" => $otherData['specialityName']]);

           if(!($speciality instanceof Speciality))
           {
                $speciality = $this->repoSpeciality->createSpeciality([
                    "fullName" => $otherData['specialityName'],
                    "abbreviation" => $specialityAbbrev,
                    "number" => $otherData['specialityCode'],
                ], $department);
           }

           $group = $this->repoGroup->findOneBy(["idName" => $otherData['groupName']]);

           if(!($group instanceof Group))
           {
                $group = $this->repoGroup->createGroup([
                    "idName" => $otherData['groupName'],
                    "eduProgram" => $otherData['opp']

                ], $speciality, []);
           }

           foreach ($studentsArr as $student) {

                try{
                    $studentName = $this->multiExplode([" "],$student["П.І.Б."]);
                    $student = $this->repoStudent->createStudent([

                        "surname" => isset($studentName[0]) ? $studentName[0] : " ",
                        "firstName" => isset($studentName[1]) ? $studentName[1] : " ",
                        "middleName" => isset($studentName[2]) ? $studentName[2] : " ",
                        "nauConditions" => $student["Умови навчання"],
                        "addressBegin" => $student["Місце реєстрації при вступі до НАУ"],
                        "studyType" => $student["Освітньо-кваліфікаційний рівень"],
                        "additionalInfo" => $student["Примітки"],

                    ],$group,[]);
                }catch(Exception $exception)
                {
                }

           }
        }
        return redirect()->route('settingsAdmin');
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

    public function clearDB(Request $request)
    {
        $data = $request->all();
        if(isset($data['subjects']) && $data['subjects'] === true)
        {
            $this->repoSubjects->clearTable();
        }
        if(isset($data['departments']) && $data['departments'] === true)
        {
            $this->repoDepartments->clearTable();
        }
        $this->repoSubjects->clearGroups();
        $this->repoStudent->clearTable();
        $this->repoGroup->clearTable();
        $this->repoSpeciality->clearTable();
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
                    /**
                     * @var Speciality $speciality
                     */
                    foreach ($specialities as $speciality)
                    {
                        $groups = $this->repoGroup->removeGroupArray($speciality->getGroupsCollection());
                    }
                    $this->repoSpeciality->removeSpecialityArray($specialities);

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
            foreach ($data["objects"] as $subjectArr){
                $subject = $this->repoSubjects->find($subjectArr["id"]);
                if($subject instanceof Subject){
                    $groups = $subject->getGroupValues();
                    /**
                     * @var Group $group
                     */
                    foreach ($groups as $group){
                        $group->getDefaultSubjectsCollection()->removeElement($subject);
                        $this->repoGroup->updateGroup($group);
                    }
                    $subject->setGroups([]);
                    $this->repoSubjects->updateSubject($subject);
                }
            }
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
                    /**
                     * @var Subject $newSubject
                     */
                    $subjects[] = $this->repoSubjects->find($subj);
                }
            }
        }

        $speciality = $this->repoSpeciality->find($data['speciality']);

        if($speciality instanceof Speciality)
        {
            $group = $this->repoGroup->createGroup($data, $speciality, $subjects);
            if($group instanceof Group){
                foreach ($subjects as $subject){
                    $subject->addGroup($group);
                    $this->repoSubjects->updateSubject($subject);
                }
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
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteGroups(Request $request)
    {
        $data = $request->all();

        if(isset($data['objects']) && !empty($data['objects']))
        {
            foreach ($data['objects'] as $group)
            {
                $speciality = $this->repoSpeciality->find($group['speciality']);
                /**
                 * @var Group $g
                 */
                $g = $this->repoGroup->find($group['id']);
                $students = $g->getStudents();
                $this->repoStudent->removeStudentArray($students);
                if($speciality instanceof Speciality && $g instanceof Group)
                {
                    $speciality->getGroupsCollection()->removeElement($g);
                    $this->repoSpeciality->updateSpeciality($speciality);
                    //$this->repoSubjects->removeGroupFromSubjects($g);
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

    public function getDisciplineMarksByGroup($id)
    {
        $disciplineMarks = [];
        $group = $this->repoGroup->find($id);
        if($group instanceof Group){
            $disciplineMarks = $this->repoGroupDiscipline->getGroupDisciplineMarks($group);
        }
        return $disciplineMarks;
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

    public function getOpp(Request $request)
    {
        $groups = $this->repoGroup->findAll();
        $oppList = [];
        foreach ($groups as $group) {
            if(!in_array($group->getEduProgram(), $oppList))
            $oppList[] = $group->getEduProgram();
        }
        return $oppList;
    }

    public function specialitySubjects(Request $request)
    {
        $data = $request->all();
        if(isset($data['subjectOpps']) && !empty(isset($data['subjectOpps'])) && isset($data['subjects']) && !empty(isset($data['subjects'])))
        {
            $oppList = $data['subjectOpps'];
            $subjectList = $data['subjects'];
            $subjects = [];
            foreach ($subjectList as $subject) {
                $sub = $this->repoSubjects->findOneBy(["id" => $subject]);
                if(!empty($subject) && $sub instanceof Subject && !is_null($subject))
                {
                    $subjects[] = $sub;
                }
            }

            foreach ($oppList as $opp) {
                if(!empty($opp))
                {
                    $groups = $this->repoGroup->findBy(["eduProgram" => $opp]);
                    /**
                     * @var Group $group
                     */
                    foreach ($groups as $group) {
                        if(!empty($subjects))
                        {
                            $group->setDefaultSubjects($subjects);
                            $this->repoGroup->updateGroup($group);
                            foreach ($subjects as $subject) {
                                $subject->addGroup($group);
                                $this->repoSubjects->updateSubject($subject);
                            }
                        }
                    }
                }
            }

        }
    }

    public function saveGroupDisciplineMarks(Request $request)
    {
        $data = $request->all();
        if(isset($data['studentData']) && !empty($data['studentData'])){
            if(is_int($data["group"]) && is_int($data["subject"])){
                $userId = $request->session()->get("id");
                $group = $this->repoGroup->find($data["group"]);
                $subject = $this->repoSubjects->find($data["subject"]);
                $user = $this->repoUser->find($userId);
                if($user instanceof User && $group instanceof Group && $subject instanceof Subject){
                    $groupDiscipline = $this->repoGroupDiscipline->saveGroupDisciplineMarks($data["studentData"], $user, $group, $subject, $data['number']);
                    return $groupDiscipline->getId();
                }
            }
        }
    }

    public function createTeacherToken(Request $request)
    {
        $data = $request->all();
        if(isset($data["particular"]) && is_bool($data["particular"])) {
            if (isset($data['id']) && is_int($data["id"]) && isset($data["subjects"])) {
                $user = $this->repoUser->find($data["id"]);
                if ($user instanceof User) {
                    if($data["particular"]){
                        $allowedSubjects = $user->getSubjects();
                        $allowedArray = [];
                        foreach($allowedSubjects as $subject){
                            $allowedArray[] = [
                                "used" => false,
                                "subject" => $subject["id"]
                            ];
                        }
                        return $this->repoTeacherToken->createTeacherToken($user, $allowedArray);
                    }
                    $allowedArray = [];
                    foreach($data["subjects"] as $subject){
                        $allowedArray[] = [
                            "used" => false,
                            "subject" => $subject["id"]
                        ];
                    }
                    return $this->repoTeacherToken->createTeacherToken($user, $allowedArray);
                }
            }
        }
    }
    public function removeAllTokens(Request $request)
    {
        $data = $request->all();
        if(isset($data['id']) && is_int($data["id"])){
            $user = $this->repoUser->find($data["id"]);
            if($user instanceof User){
                return $this->repoTeacherToken->removeAllTokens();
            }
        }
    }
}
