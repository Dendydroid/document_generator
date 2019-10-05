<?php
namespace App\Repositories;
use App\Constants;
use App\Entities\Department;
use App\Entities\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * Class DepartmentRepo
 * @package App\Repositories
 */
class DepartmentRepo extends EntityRepository {

    /**
     * @var string
     */
    private $class = 'App\Entities\Department';


    /**
     * @param array $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateDepartment(array $request)
    {
        $validator = Validator::make($request, [
            "fullName" => "required|max:255",
            "abbreviation" => "required|max:255",
        ]);

        return $validator;
    }

    /**
     * @param Department $department
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateDepartment(Department $department)
    {
        $this->_em->persist($department);
        $this->_em->flush();
    }

    /**
     * @param Request $request
     * @return array|mixed
     */
    public function getDepartments(Request $request)
    {
        $results = [];
        $qb = $this->_em->createQueryBuilder();
        $qb->select('f')
            ->from('App\Entities\Department', 'f')
            ->orderBy('f.fullName', 'ASC');

        $results = $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);
        return $results;
    }

    /**
     * @param $data
     * @return Department|array
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createDepartment($data)
    {
        $errors = ["errors" => null];
        $validation = $this->validateDepartment($data);
        if(!$validation->fails())
        {
            $department = new Department();
            $department->setFullName($data['fullName'])
                ->setAbbreviation($data['abbreviation'])
                ->setHead($data['head']);
            $this->_em->persist($department);
            $this->_em->flush();
            return $department;
        }
        $errors["errors"] = $validation->errors()->getMessages();
        return $errors;
    }

    /**
     * @param $data
     * @return array|object|null
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function editDepartment($data)
    {
        $errors = ["errors" => null];
        $validation = $this->validateDepartment($data);
        if(!$validation->fails())
        {
            $department = $this->find($data['id']);
            $department->setFullName($data['fullName'])
                ->setAbbreviation($data['abbreviation'])
                ->setHead($data['head']);
            $this->_em->persist($department);
            $this->_em->flush();
            return $department;
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
    public function deleteDepartments(array $objects)
    {
        $removed = [];
        foreach ($objects as $object){
            $department = $this->find($object['id']);
            if($department instanceof Department)
            {
                $this->_em->remove($department);
                $this->_em->flush();
                $removed[] = $object;
            }else{
                $removed[] = null;
            }
        }
        return $removed;
    }
}

