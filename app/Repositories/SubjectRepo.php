<?php
namespace App\Repositories;
use App\Constants;
use App\Entities\Department;
use App\Entities\Speciality;
use App\Entities\Subject;
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
 * Class SubjectRepo
 * @package App\Repositories
 */
class SubjectRepo extends EntityRepository {

    /**
     * @var string
     */
    private $class = 'App\Entities\Subject';


    /**
     * @param array $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateSubject(array $request)
    {
        $validator = Validator::make($request, [
            "name" => "required|max:255",
            "professor" => "required|max:255",
            "headOfDepartment" => "required|max:255",
            "moduleCount" => "required|numeric",
            "hoursCount" => "required|numeric",
            "creditsCount" => "required|numeric",
            "date" => "required|max:255"
        ]);

        return $validator;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getSubjects(Request $request)
    {
        $results = [];
        $q = $this->findAll();

        /**
         * @var Subject $subject
         */
        foreach ($q as $subject)
        {
            $results[] = $subject->getTableArray();
        }
        return $results;
    }

    /**
     * @param array $data
     * @return Subject|array
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createSubject(array $data)
    {
        $errors = ["errors" => null];
        $validation = $this->validateSubject($data);
        if(!$validation->fails())
        {
            $subject = new Subject();
            $subject->setName($data['name'])
                ->setMainProfessor($data['professor'])
                ->setHeadOfDepartment($data['headOfDepartment'])
                ->setModuleCount($data['moduleCount'])
                ->setHoursCount($data['hoursCount'])
                ->setCreditsCount($data['creditsCount'])
                ->setDate($data['date']);
            $this->_em->persist($subject);
            $this->_em->flush();

            return $subject;
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
    public function editSubject($data)
    {
        $errors = ["errors" => null];
        $validation = $this->validateSubject($data);
        if(!$validation->fails())
        {
            $subject = $this->find($data['id']);
            $subject->setName($data['name'])
                ->setMainProfessor($data['professor'])
                ->setHeadOfDepartment($data['headOfDepartment'])
                ->setModuleCount($data['moduleCount'])
                ->setHoursCount($data['hoursCount'])
                ->setCreditsCount($data['creditsCount'])
                ->setDate($data['date']);
            $this->_em->persist($subject);
            $this->_em->flush();

            return $subject;
        }
        $errors["errors"] = $validation->errors()->getMessages();
        return $errors;
    }



    public function deleteSubjects(array $objects)
    {
        $removed = [];
        foreach ($objects as $object){
            $subject = $this->find($object['id']);

            if($subject instanceof Subject)
            {
                $this->_em->remove($subject);
                $this->_em->flush();
                $removed[] = $object;
            }else{
                $removed[] = null;
            }
        }
        return $removed;
    }

}

