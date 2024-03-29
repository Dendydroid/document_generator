<?php

namespace App\Http\Controllers;
use App\Entities\TeacherToken;
use App\Entities\User;
use App\Entities\Subject;
use App\Repositories\UserRepo as repo;
use App\Repositories\SubjectRepo;
use Doctrine\ORM\EntityManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Constants;
use Illuminate\Validation\Rule;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @var string
     */
    private $subjectClass;

    /**
     * @var \App\Repositories\SubjectRepo
     */
    private $subjectRepo;

    /**
     * @var string
     */
    private $teacherTokenClass;

    /**
     * @var \App\Repositories\TeacherTokenRepo
     */
    private $teacherTokenRepo;

    /**
     * @var string
     */
    private $groupDisciplineMarksClass;

    /**
     * @var \App\Repositories\GroupDisciplineMarksRepo
     */
    private $groupDisciplineMarksRepo;

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
        $this->subjectClass = "App\Entities\Subject";
        $this->teacherTokenClass = "App\Entities\TeacherToken";
        $this->groupDisciplineMarksClass = "App\Entities\GroupDisciplineMarks";
        $this->entityManager = $entityManager;
        $this->userRepo = $this->entityManager->getRepository($this->userClass);
        $this->subjectRepo = $this->entityManager->getRepository($this->subjectClass);
        $this->teacherTokenRepo = $this->entityManager->getRepository($this->teacherTokenClass);
        $this->groupDisciplineMarksRepo = $this->entityManager->getRepository($this->groupDisciplineMarksClass);
    }

    public function getTeacherSubjectsList(Request $request)
    {
        $user = $this->userRepo->find($request->get('id'));
        return $user instanceof User ? $user->getSubjects() : [];
    }

    public function getTeacherSubjects(Request $request)
    {
        $user = $this->userRepo->find($request->session()->get('id'));
        $subjectList = [];
        if($user instanceof User){
            $subjects = $user->getSubjectsCollection();
            /**
             * @var Subject $subject
             */
            foreach ($subjects as $subject){
                $subjectList[] = [
                    "subject" => $subject->getTableArray(),
                    "groups" => $subject->getGroups()
                ];
            }
            return $subjectList;
        }
        return [];
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

    public function validateProfileData(Array $request, bool $noTeacher = false)
    {
        $id = $request['id'];
        $validator = Validator::make($request, [
            "firstName" => "required|alpha|max:255",
            "surname" => "required|alpha|max:255|",
            "middleName" => "required|alpha|max:255",
            "email" => "required|email|unique:App\Entities\User,email,$id|max:255|min:4",
            "isTeacher" => !$noTeacher ? "required|boolean|max:255" : "",
        ]);

        return $validator;
    }

    public function validatePassword(Array $request)
    {
        $validator = Validator::make($request, [
            "password" => "required|max:255|min:6",
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
        if($request->session()->get('isAdmin') || $this->userRepo->noUsers())
        {
            $data = $request->all();
            $validation = $this->validateUser($data);
            if(!$validation->fails()){
                $user = new User();
                $user->setEmail($data['email'])
                    ->setFirstName($data['firstName'])
                    ->setSurname($data['surname'])
                    ->setMiddleName($data['middleName'])
                    ->setPassword(Hash::make($data['password']))
                    ->setIsTeacher($data['isTeacher']);

                if(isset($data['subjects']) && !empty($data['subjects'])){
                    $subjects = $this->subjectRepo->findById($data['subjects']);
                    if(!empty($subjects)){
                        $user->setSubjects($subjects);
                    }
                }


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
        $validation = $this->validatePassword($request->all());
        if(!$validation->fails())
            return $this->userRepo->updatePassword($request);

        return response()->json(["failed"=>1,"errors"=>$validation->errors()], 400);
    }

    public function updateProfileData(Request $request)
    {
        $validation = $this->validateProfileData($request->all(), true);
        if(!$validation->fails())
            return $this->userRepo->updateProfileData($request);

        return response()->json(["failed"=>1,"errors"=>$validation->errors()], 400);
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

    public function getUsers(Request $request)
    {
        $users = $this->userRepo->findAll();
        $data = [];

        if(!empty($users))
        {
            foreach ($users as $user) {
                $data[] = $user->getUserTableArray();
            }
        }

        return $data;
    }

    public function deleteUsers(Request $request)
    {
        $data = $request->all();
        if(isset($data['objects']) && !empty($data['objects']))
        {
            foreach ($data['objects'] as $user)
            {
                $groupDisciplineMarks = $this->groupDisciplineMarksRepo->findBy(["user" => $user['id']]);

                $this->teacherTokenRepo->removeAllTokens($user['id']);

                foreach ($groupDisciplineMarks as $groupDisciplineMark)
                {
                    $this->groupDisciplineMarksRepo->deleteGroupDisciplineMark($groupDisciplineMark);
                }
            }

            return $this->userRepo->deleteUsers($data['objects']);
        }
        return Constants::OPERATION_FAILED;
    }

    public function getAllowedSubjects(Request $request)
    {
        $userId = session()->all()['id'] ?? [];

        $teacherTokens = $this->teacherTokenRepo->findBy(["user" => $userId]);

        $allowedSubjects = [];

        /**
         * @var TeacherToken $teacherToken
         */
        foreach ($teacherTokens as $teacherToken)
        {
            $subjects = json_decode($teacherToken->getAllowedSubjects(), true);
            foreach ($subjects as $subject)
            {
                if(!$subject['used'] && !isset($allowedSubjects[$subject['subject']])){
                    $allowedSubjects[] = $subject['subject'];
                }
            }
        }

        return $allowedSubjects;
    }

    public function getAllowedSubjectsAdmin(Request $request)
    {
        $userId = $request->get('id');

        $teacherTokens = $this->teacherTokenRepo->findBy(["user" => $userId]);

        $allowedSubjects = [];

        /**
         * @var TeacherToken $teacherToken
         */
        foreach ($teacherTokens as $teacherToken)
        {
            $subjects = json_decode($teacherToken->getAllowedSubjects(), true);
            foreach ($subjects as $subject)
            {
                if(!$subject['used'] && !isset($allowedSubjects[$subject['subject']])){
                    $subj = $this->subjectRepo->find($subject['subject']);
                    $allowedSubjects[] = ["id" => $subject['subject'], "name" => $subj->getName()];
                }
            }
        }

        return $allowedSubjects;
    }
}
