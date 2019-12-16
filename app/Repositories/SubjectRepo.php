<?php
namespace App\Repositories;
use App\Constants;
use App\Entities\Department;
use App\Entities\Group;
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
            "date" => "required|max:255",
            "hasCourse" => "max:1",
            "hasPass" => "max:1",
            "hasExam" => "max:1",
            "hasPractice" => "max:1",
        ]);

        return $validator;
    }

    public function removeGroupFromSubjects(Group $group){
        $subjects = $this->findAll();
        /**
         * @var Subject $subject
         */
        foreach ($subjects as $subject) {
           if($subject->getGroupsCollection()->contains($group)){
               $subject->getGroupsCollection()->removeElement($group);
           }
            $this->_em->persist($subject);
            $this->_em->flush();
        }
    }

    public function clearGroups(){
        $subjects = $this->findAll();

        foreach ($subjects as $subject) {
            $subject->setGroups([]);
            $this->_em->persist($subject);
            $this->_em->flush();
        }
    }

    public function updateSubject(Subject $subject){
        $this->_em->persist($subject);
        $this->_em->flush();
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

            if(isset($data['hasCourse']) && !empty($data['hasCourse']))
            {
                $subject->setHasCourse($data['hasCourse']);
            }
            if(isset($data['hasPass']) && !empty($data['hasPass']))
            {
                $subject->setHasPass($data['hasPass']);
            }
            if(isset($data['hasExam']) && !empty($data['hasExam']))
            {
                $subject->setHasExam($data['hasExam']);
            }
            if(isset($data['hasPractice']) && !empty($data['hasPractice']))
            {
                $subject->setHasPractice($data['hasPractice']);
            }


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

            if(isset($data['hasCourse']) && !empty($data['hasCourse']))
            {
                $subject->setHasCourse($data['hasCourse']);
            }else{
                $subject->setHasCourse(0);
            }
            if(isset($data['hasPass']) && !empty($data['hasPass']))
            {
                $subject->setHasPass($data['hasPass']);
            }else{
                $subject->setHasPass(0);
            }
            if(isset($data['hasExam']) && !empty($data['hasExam']))
            {
                $subject->setHasExam($data['hasExam']);
            }else{
                $subject->setHasExam(0);
            }
            if(isset($data['hasPractice']) && !empty($data['hasPractice']))
            {
                $subject->setHasPractice($data['hasPractice']);
            }else{
                $subject->setHasPractice(0);
            }


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

    public function clearTable()
    {
        $connection = $this->_em->getConnection();
        $connection->executeQuery('SET FOREIGN_KEY_CHECKS = 0;');
        $platform   = $connection->getDatabasePlatform();

        $connection->executeUpdate($platform->getTruncateTableSQL('subjects', true));
        $connection->executeQuery('SET FOREIGN_KEY_CHECKS = 1;');
    }

}

