<?php
namespace App\Repositories;
use App\Constants;
use App\Entities\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\ORMException;
use http\Env\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserRepo
 * @package App\Repositories
 */
class UserRepo extends EntityRepository {

    /**
     * @var string
     */
    private $class = 'App\Entities\User';

    /**
     * @return bool
     */
    public function noUsers()
    {
        $users = $this->findAll();

        return empty($users) ? true : false;
    }

    public function create(User $user)
    {
        if($this->noUsers())
        {
            $user->setIsAdmin(true);
        }

        try {
            $this->_em->persist($user);
        }catch(ORMException $e) {
            throw new \Exception("UserRepo.create: " + $e->getMessage());
        }
        $this->_em->flush();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function login(array $data)
    {
        /**
         * User $user
         */
        $user = $this->_em->getRepository('App\Entities\User')->findOneBy(["email" => $data['email']]);

        if(!is_null($user) && Hash::check($data['password'], $user->getPassword())){
            session($user->getUserArray());
            return true;
        }
        return false;
    }

    public function getLoggedUser(\Illuminate\Http\Request $request)
    {
        return $this->_em->getRepository('App\Entities\User')->findOneBy(["email" => $request->session()->get('email')]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updatePassword(\Illuminate\Http\Request $request)
    {
        /**
         * User $user
         */
        $user = $this->getLoggedUser($request);


        if(!is_null($user) && Hash::check($request->get('oldPassword'), $user->getPassword())){
            $user->setPassword(Hash::make($request->get("password")));
            $this->_em->persist($user);
            $this->_em->flush();
            return Constants::OPERATION_SUCCESSFUL;
        }
        return response()->json(Constants::WRONG_PASSWORD, 400);
    }

    public function updateProfileData(\Illuminate\Http\Request $request)
    {
        /**
         * User $user
         */
        $user = $this->getLoggedUser($request);

        $data = $request->all();
        if(!is_null($user) && Hash::check($data['password'], $user->getPassword())){
            $user->setEmail($data['email'])
            ->setFirstName($data['firstName'])
            ->setSurname($data['surname'])
            ->setMiddleName($data['middleName']);
            $request->session()->forget(["email"]);
            $request->session()->put(["email" => $data['email']]);
            $request->session()->forget(["firstName"]);
            $request->session()->put(["firstName" => $data['firstName']]);
            $request->session()->forget(["surname"]);
            $request->session()->put(["surname" => $data['surname']]);
            $request->session()->forget(["middleName"]);
            $request->session()->put(["middleName" => $data['middleName']]);
            $this->_em->persist($user);
            $this->_em->flush();
            return Constants::OPERATION_SUCCESSFUL;
        }
        return response()->json(Constants::WRONG_PASSWORD, 400);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function removeUser(\Illuminate\Http\Request $request)
    {
        /**
         * User $user
         */
        $user = $this->getLoggedUser($request);

        if(!is_null($user) && Hash::check($request->get('password'), $user->getPassword())){
            $this->_em->remove($user);
            $this->_em->flush();
            $request->session()->forget(Constants::SESSION_USER_DATA_KEYS);
            return Constants::OPERATION_SUCCESSFUL;
        }

        return Constants::OPERATION_FAILED;
    }

    public function updateTheme($data,$id)
    {
        /**
         * User $user
         */
        $user = $this->find($id);
        $user->setTheme($data);
        $this->_em->persist($user);
        $this->_em->flush();
        return $user;
    }

    public function deleteUsers(array $objects)
    {
        $removed = [];
        foreach ($objects as $object){
            $user = $this->find($object['id']);

            if($user instanceof User)
            {
                $user->setSubjects([]);
                $this->_em->persist($user);
                $this->_em->remove($user);
                $this->_em->flush();
                $removed[] = $object;
            }else{
                $removed[] = null;
            }
        }
        return $removed;
    }

}

