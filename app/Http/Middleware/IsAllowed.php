<?php

namespace App\Http\Middleware;

use App\Repositories\TeacherTokenRepo;
use Closure;
use Doctrine\ORM\EntityManager;

class IsAllowed
{
    /**
     * @var TeacherTokenRepo
     */
    private $repoTeacherToken;

    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repoTeacherToken = $this->entityManager->getRepository("App\Entities\TeacherToken");
    }


    /**
     * @param $request
     * @param Closure $next
     * @return mixed|string
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        if (!$request->session()->get("isTeacher")) {
            return "Вы не преподаватель.";
        }else{
            $tokens = $this->repoTeacherToken->findAll();
            foreach ($tokens as $token){
                if($token->getUser()->getId() === $request->session()->get("id")){
                    $isExpired = new \DateTime($token->getExpiryDate()) < new \DateTime();
                    if(!$isExpired && isset($request->all()["subject"])){
                        $subjects = json_decode($token->getAllowedSubjects(),true);
                        $gotSubject = $request->all()["subject"];
                        foreach ($subjects as $key => $subject){
                            if($subject["subject"] === $gotSubject && !$subject["used"]){
                                $subjects[$key]["used"] = true;
                                $token->setAllowedSubjects(json_encode($subjects));
                                $this->repoTeacherToken->updateToken($token);
                                return $next($request);
                            }
                        }
                    }
                }
            }
        }
        return "Доступ запрещен.";
    }
}
