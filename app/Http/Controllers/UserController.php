<?php

namespace App\Http\Controllers;
use App\Entities\User;
use App\Repositories\UserRepo as repo;
use Doctrine\ORM\EntityManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Constants;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller {

    /**
     * @var string
     */
    private $userClass;

    /**
     * @var \App\Repositories\UserRepo
     */
    private $userRepo;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * UserController constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->userClass = "App\Entities\User";
        $this->entityManager = $entityManager;
        $this->userRepo = $this->entityManager->getRepository($this->userClass);
    }

    /**
     * @param array $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateUser(Array $request)
    {
        $validator = Validator::make($request, [
            "firstName" => "required|alpha|max:255",
            "surname" => "required|alpha|max:255|",
            "middleName" => "required|alpha|max:255",
            "password" => "required|max:255|min:6",
            "email" => "required|email|unique:App\Entities\User,email|max:255|min:4"
        ]);

        return $validator;
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Support\MessageBag
     * @throws \Exception
     */
    public function createUser(Request $request)
    {
        if($request->session()->get('isAdmin'))
        {
            $data = $request->all();
            $validation = $this->validateUser($data);
            if(!$validation->fails()){
                $user = new User();
                $user->setEmail($data['email'])
                    ->setFirstName($data['firstName'])
                    ->setSurname($data['surname'])
                    ->setMiddleName($data['middleName'])
                    ->setPassword(Hash::make($data['password']));
                $this->userRepo->create($user);
            }else{
                return response()->json($validation->errors(), 400);
            }
            return Constants::SUCCESSFUL_REGISTRATION;
        }
        return response()->json(Constants::OPERATION_SUPER_FAILED, 400);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function loginUser(Request $request)
    {
        $data = $request->all();
        $result = $this->userRepo->login($data);
        if($result){
            $request->session()->put("logged",true);
            return Constants::SUCCESSFUL_LOGIN;
        }
        return response()->json(Constants::OPERATION_FAILED, 400);
    }

    public function logout(Request $request)
    {
        $request->session()->forget(Constants::SESSION_USER_DATA_KEYS);
        return redirect('/login');
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updatePassword(Request $request)
    {
        return $this->userRepo->updatePassword($request);
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function removeUser(Request $request)
    {
        return $this->userRepo->removeUser($request);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getUserSession(Request $request)
    {
        $session = $request->session()->all();
        $result = [];
        foreach (Constants::SESSION_USER_DATA_KEYS as $key)
        {
            $result[$key] = $request->session()->get($key);
        }
        return $result;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function hasNoUsers(Request $request)
    {
        if($this->userRepo->noUsers())
        {
            return Constants::OPERATION_SUCCESSFUL;
        }
        return response()->json(Constants::OPERATION_FAILED, 400);
    }

    public function updateTheme(Request $request)
    {
        $user = $this->userRepo->updateTheme($request->all(), $request->session()->all()['id']);
        $request->session()->forget(["theme"]);
        $request->session()->put(["theme" => $user->getTheme()]);
    }

}
