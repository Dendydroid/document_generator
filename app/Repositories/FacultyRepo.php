<?php
namespace App\Repositories;
use App\Constants;
use App\Entities\Faculty;
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
 * Class FacultyRepo
 * @package App\Repositories
 */
class FacultyRepo extends EntityRepository {

    /**
     * @var string
     */
    private $class = 'App\Entities\Faculty';


    /**
     * @param array $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateFaculty(array $request)
    {
        $validator = Validator::make($request, [
            "fullName" => "required|max:255",
            "abbreviation" => "required|max:255",
        ]);

        return $validator;
    }

    public function getFaculties(Request $request)
    {
        $results = [];
        $qb = $this->_em->createQueryBuilder();
        $qb->select('f')
            ->from('App\Entities\Faculty', 'f')
            ->orderBy('f.fullName', 'ASC');

        $results = $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);
        return $results;
    }

    /**
     * @param $data
     * @return Faculty|array
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createFaculty($data)
    {
        $errors = ["errors" => null];
        $validation = $this->validateFaculty($data);
        if(!$validation->fails())
        {
            $faculty = new Faculty();
            $faculty->setFullName($data['fullName'])
                ->setAbbreviation($data['abbreviation']);
            $this->_em->persist($faculty);
            $this->_em->flush();
            return $faculty;
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
    public function editFaculty($data)
    {
        $errors = ["errors" => null];
        $validation = $this->validateFaculty($data);
        if(!$validation->fails())
        {
            $faculty = $this->find($data['id']);
            $faculty->setFullName($data['fullName'])
                ->setAbbreviation($data['abbreviation']);
            $this->_em->persist($faculty);
            $this->_em->flush();
            return $faculty;
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
    public function deleteFaculties(array $objects)
    {
        $removed = [];
        foreach ($objects as $object){
            $faculty = $this->find($object['id']);
            if($faculty instanceof Faculty)
            {
                $this->_em->remove($faculty);
                $this->_em->flush();
                $removed[] = $object;
            }else{
                $removed[] = null;
            }
        }
        return $removed;
    }
}

