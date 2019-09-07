<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Entities\Faculty;
use App\Repositories\InstituteRepo;
use App\Repositories\SpecialityRepo;
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
     * DataController constructor.
     * @param $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

        $this->repoFaculties = $this->entityManager->getRepository($this->faculty);
        $this->repoSpeciality = $this->entityManager->getRepository($this->speciality);
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

    public function getFacultyData(Request $request)
    {
       return $this->repoFaculties->getFaculties($request);
    }


    /**
     * @param Request $request
     * @return array
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createFaculty(Request $request)
    {
        $data = $request->all();
        $faculty = $this->repoFaculties->createFaculty($data);
        if($faculty instanceof Faculty){
            return array_merge(
                Constants::OPERATION_SUCCESSFUL,
                ["id" => $faculty->getId()]
            );
        }else{
            return array_merge(Constants::OPERATION_FAILED,$faculty);
        }
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteFaculty(Request $request)
    {
        $data = $request->all();
        if(isset($data['id']) && !empty($data['id']))
        {
            if($this->repoFaculties->deleteFaculty($data['id']))
            {
                return Constants::OPERATION_SUCCESSFUL;
            }
        }
        return Constants::OPERATION_FAILED;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editFaculty(Request $request)
    {
        $data = $request->all();
        $faculty = $this->repoFaculties->editFaculty($data);
        if($faculty instanceof Faculty){
            return array_merge(
                Constants::OPERATION_SUCCESSFUL,
                ["id" => $faculty->getId()]
            );
        }else{
            return array_merge(Constants::OPERATION_FAILED,$faculty);
        }
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createInstitute(Request $request)
    {
        $data = $request->all();
        $faculty = null;
        $institute = null;
        if(isset($data['facultyId']) && !empty($data['facultyId'])) {
            $faculty = $this->repoFaculties->find($data['facultyId']);
        }
        if(!is_null($faculty)) {
            $institute = $this->repoInstitutes->createInstitute($data, $faculty);
            if($institute instanceof $institute){
                return array_merge(
                    Constants::OPERATION_SUCCESSFUL,
                    ["id" => $institute->getId()]
                );
            }
        }
        return array_merge(Constants::OPERATION_FAILED,$institute);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getInstitutesData(Request $request)
    {
        $data = $this->repoInstitutes->findAll();

        $tableData = [
            "draw" => 10,
            "recordsTotal" => count($data),
            "recordsFiltered" => count($data),
            "data" => []
        ];
        foreach ($data as $record) {

            $tableData["data"][] = $record->getTableArray();
        }

        return $tableData;
    }

    public function deleteInstitute(Request $request)
    {
        $data = $request->all();
        if(isset($data['id']) && !empty($data['id']))
        {
            if($this->repoInstitutes->deleteInstitute($data['id']))
            {
                return Constants::OPERATION_SUCCESSFUL;
            }
        }
        return Constants::OPERATION_FAILED;
    }
}
