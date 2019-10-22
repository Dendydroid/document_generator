<?php
namespace App\Repositories;
use App\Constants;
use App\Entities\Department;
use App\Entities\Speciality;
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
    public function validateSpeciality(array $request)
    {
        $validator = Validator::make($request, [
            "fullName" => "required|max:255",
            "abbreviation" => "required|max:255",
            "number" => "required|max:255",
        ]);

        return $validator;
    }

    public function updateSpeciality(Speciality $speciality)
    {
        $this->_em->persist($speciality);
        $this->_em->flush();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getSpecialities(Request $request)
    {
        $results = [];
        $q = $this->findAll();

        /**
         * @var Speciality $speciality
         */
        foreach ($q as $speciality)
        {
            $results[] = $speciality->getTableArray();
        }
        return $results;
    }

    /**
     * @param array $data
     * @param Department $department
     * @return Speciality|array
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createSpeciality(array $data, Department $department)
    {
        $errors = ["errors" => null];
        $validation = $this->validateSpeciality($data);
        if(!$validation->fails())
        {
            $speciality = new Speciality();
            $speciality->setFullName($data['fullName'])
                ->setAbbreviation($data['abbreviation'])
                ->setNumber($data['number'])
                ->setDepartment($department);
            $this->_em->persist($speciality);
            $this->_em->flush();

            return $speciality;
        }
        $errors["errors"] = $validation->errors()->getMessages();
        return $errors;
    }

    /**
     * @param $data
     * @param Department $department
     * @return array|object|null
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editSpeciality($data, Department $department)
    {
        $errors = ["errors" => null];
        $validation = $this->validateSpeciality($data);
        if(!$validation->fails())
        {

            $speciality = $this->find($data['id']);
            $speciality->setFullName($data['fullName'])
                ->setAbbreviation($data['abbreviation'])
                ->setNumber($data['number'])
                ->setDepartment($department);
            $this->_em->persist($speciality);
            $this->_em->flush();

            return $speciality;
        }
        $errors["errors"] = $validation->errors()->getMessages();
        return $errors;
    }


    /**
     * @param array $objects
     * @return array
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteSpecialities(array $objects)
    {
        $removed = [];
        foreach ($objects as $object){
            $speciality = $this->find($object['id']);

            if($speciality instanceof Speciality)
            {
                $this->_em->remove($speciality);
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
    public function removeSpecialityArray($array)
    {
        if(!empty($array))
        {
            foreach ($array as $speciality)
            {
                $this->_em->remove($speciality);
                $this->_em->flush();
            }
        }
    }

    public function clearTable()
    {
        $connection = $this->_em->getConnection();
        $connection->executeQuery('SET FOREIGN_KEY_CHECKS = 0;');
        $platform   = $connection->getDatabasePlatform();

        $connection->executeUpdate($platform->getTruncateTableSQL('specialities', true));
        $connection->executeQuery('SET FOREIGN_KEY_CHECKS = 1;');
    }
}

