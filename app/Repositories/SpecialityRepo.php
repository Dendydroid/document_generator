<?php
namespace App\Repositories;
use App\Constants;
use App\Entities\Faculty;
use App\Entities\Speciality;
use App\Entities\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\ORMException;
use http\Env\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * Class SpecialityRepo
 * @package App\Repositories
 */
class SpecialityRepo extends EntityRepository {

    /**
     * @var string
     */
    private $class = 'App\Entities\Speciality';


    /**
     * @param array $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateInstitute(array $request)
    {
        $validator = Validator::make($request, [
            "fullName" => "required|max:255",
            "abbreviation" => "required|max:255",
        ]);

        return $validator;
    }

    /**
     * @param array $data
     * @param Faculty $faculty
     * @return Speciality|array
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createInstitute(array $data,Faculty $faculty)
    {
        $errors = ["errors" => null];
        $validation = $this->validateInstitute($data);
        if(!$validation->fails())
        {

            $institute = new Speciality();
            $institute->setFullName($data['fullName'])
                ->setAbbreviation($data['abbreviation'])
                ->setFaculty($faculty);
            $this->_em->persist($institute);
            $this->_em->flush();

            $faculty->addInstitute($institute);
            $this->_em->persist($faculty);
            $this->_em->flush();

            return $institute;
        }
        $errors["errors"] = $validation->errors()->getMessages();
        return $errors;
    }

    /**
     * @param int $id
     * @return bool
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteInstitute(int $id)
    {
        $institute = $this->find($id);
        if($institute instanceof Speciality)
        {
            $this->_em->remove($institute);
            $this->_em->flush();
            return true;
        }
        return false;
    }
}

