<?php
namespace App\Repositories;
use App\Entities\FacultyInfo;
use App\Entities\Group;
use App\Entities\Speciality;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\ORMException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class FacultyInfoRepo
 * @package App\Repositories
 */
class FacultyInfoRepo extends EntityRepository {

    /**
     * @var string
     */
    private $class = 'App\Entities\FacultyInfo';


    /**
     * @param array $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateFacultyInfo(array $request)
    {
        $validator = Validator::make($request, [
            "fullName" => "required|max:255",
            "abbreviation" => "required|max:255",
            "rectorFIO" => "required|max:255",
        ]);

        return $validator;
    }

    /**
     * @param array $data
     * @return FacultyInfo|array|null
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateFacultyInfo(array $data)
    {
        $errors = ["errors" => null];
        $validation = $this->validateFacultyInfo($data);
        if(!$validation->fails())
        {
            $facultyInfo = $this->getFacultyInfo(true);

            if(!$facultyInfo instanceof FacultyInfo)
            {
                $facultyInfo = new FacultyInfo();
            }

            $facultyInfo->setFullName($data['fullName'])
                ->setAbbreviation($data['abbreviation'])
                ->setRectorFIO($data['rectorFIO']);

            $this->_em->persist($facultyInfo);
            $this->_em->flush();
            return $facultyInfo;
        }
        $errors["errors"] = $validation->errors()->getMessages();
        return $errors;
    }

    /**
     * @param bool $entity
     * @return FacultyInfo|array|null
     */
    public function getFacultyInfo($entity = false)
    {
        $facultyInfo = $this->findAll();
        if($entity)
        {
            return $facultyInfo[0] instanceof FacultyInfo ? $facultyInfo[0] : null;
        }
        return $facultyInfo[0] instanceof FacultyInfo ? $facultyInfo[0]->getTableArray() : [];
    }
}

