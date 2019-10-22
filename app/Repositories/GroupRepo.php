<?php
namespace App\Repositories;
use App\Constants;
use App\Entities\Department;
use App\Entities\Group;
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
 * Class GroupRepo
 * @package App\Repositories
 */
class GroupRepo extends EntityRepository {

    /**
     * @var string
     */
    private $class = 'App\Entities\Group';


    /**
     * @param array $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateGroup(array $request)
    {
        $validator = Validator::make($request, [
            "idName" => "required|max:255",
            "eduProgram" => "required|max:255",
        ]);

        return $validator;
    }

    public function updateGroup(Group $group)
    {
        $this->_em->persist($group);
        $this->_em->flush();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getGroups(Request $request)
    {
        $results = [];
        $q = $this->findAll();

        /**
         * @var Group $group
         */
        foreach ($q as $group)
        {
            $results[] = $group->getTableArray();
        }
        return $results;
    }


    public function createGroup(array $data,Speciality $speciality, $subjectArr)
    {
        $errors = ["errors" => null];
        $validation = $this->validateGroup($data);
        if(!$validation->fails())
        {
            /**
             * @var Group $group
             */
            $group = new Group();

            if(!empty($subjectArr))
            {
                foreach ($subjectArr as $subject)
                {
                    $group->addDefaultSubject($subject);
                }
            }

            $group->setIdName($data['idName'])
                ->setSpeciality($speciality)
                ->setEduProgram($data['eduProgram']);

            if(isset($data['curatorFIO']) && !empty($data['curatorFIO']))
            {
                $group->setCuratorFIO($data['curatorFIO']);
            }
            if(isset($data['curatorPhone']) && !empty($data['curatorPhone']))
            {
                $group->setCuratorPhone($data['curatorPhone']);
            }
            if(isset($data['headmanFIO']) && !empty($data['headmanFIO']))
            {
                $group->setHeadmanFIO($data['headmanFIO']);
            }
            if(isset($data['headmanPhone']) && !empty($data['headmanPhone']))
            {
                $group->setHeadmanPhone($data['headmanPhone']);
            }

            $this->_em->persist($group);
            $this->_em->flush();

            return $group;
        }
        $errors["errors"] = $validation->errors()->getMessages();
        return $errors;
    }


    public function editGroup($data,Speciality $speciality, $subjectArr)
    {
        $errors = ["errors" => null];
        $validation = $this->validateGroup($data);
        if(!$validation->fails())
        {
            /**
             * @var Group $group
             */
            $group = $this->find($data['id']);
            $group->getDefaultSubjectsCollection()->clear();

            if(!empty($subjectArr))
            {
                foreach ($subjectArr as $subject)
                {
                    $group->addDefaultSubject($subject);
                }
            }

            $group->setIdName($data['idName'])
                 ->setSpeciality($speciality)
                 ->setEduProgram($data['eduProgram']);

            if(isset($data['curatorFIO']) && !empty($data['curatorFIO']))
            {
                $group->setCuratorFIO($data['curatorFIO']);
            }
            if(isset($data['curatorPhone']) && !empty($data['curatorPhone']))
            {
                $group->setCuratorPhone($data['curatorPhone']);
            }
            if(isset($data['headmanFIO']) && !empty($data['headmanFIO']))
            {
                $group->setHeadmanFIO($data['headmanFIO']);
            }
            if(isset($data['headmanPhone']) && !empty($data['headmanPhone']))
            {
                $group->setHeadmanPhone($data['headmanPhone']);
            }

            $this->_em->persist($group);
            $this->_em->flush();

            return $group;
        }
        $errors["errors"] = $validation->errors()->getMessages();
        return $errors;
    }



    public function deleteGroups(array $objects)
    {
        $removed = [];
        foreach ($objects as $object){
            $group = $this->find($object['id']);

            if($group instanceof Group)
            {
                $this->_em->remove($group);
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
    public function removeGroupArray($array)
    {
        if(!empty($array))
        {
            foreach ($array as $group)
            {
                $this->_em->remove($group);
                $this->_em->flush();
            }
        }
    }

    public function clearTable()
    {
        $connection = $this->_em->getConnection();
        $connection->executeQuery('SET FOREIGN_KEY_CHECKS = 0;');
        $platform   = $connection->getDatabasePlatform();

        $connection->executeUpdate($platform->getTruncateTableSQL('groups', true));
        $connection->executeUpdate($platform->getTruncateTableSQL('groups_subjects', true));
        $connection->executeQuery('SET FOREIGN_KEY_CHECKS = 1;');
    }
}

