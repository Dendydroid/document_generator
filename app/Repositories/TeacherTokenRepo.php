<?php
namespace App\Repositories;
use App\Constants;
use App\Entities\Department;
use App\Entities\Group;
use App\Entities\GroupDisciplineMarks;
use App\Entities\Speciality;
use App\Entities\Subject;
use App\Entities\TeacherToken;
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
 * Class TeacherTokenRepo
 * @package App\Repositories
 */
class TeacherTokenRepo extends EntityRepository {

    const EXPIRY_RANGE = 1440; // MINUTES ( 1440 - day )

    /**
     * @var string
     */
    private $class = 'App\Entities\TeacherToken';

    public function updateToken(TeacherToken $token)
    {
        $this->_em->persist($token);
        $this->_em->flush();
    }

    public function createTeacherToken(User $user, array $allowedSubjects)
    {
        $this->removeAllTokens();

        $teacherToken = new TeacherToken();
        $teacherToken->setUser($user);

        $time = new \DateTime(date("Y-m-d H:i"));
        $time->add(new \DateInterval('PT' . self::EXPIRY_RANGE . 'M'));
        $stamp = $time->format('Y-m-d H:i');
        $teacherToken->setAllowedSubjects(json_encode($allowedSubjects));
        $teacherToken->setExpiryDate($stamp);

        $this->_em->persist($teacherToken);
        $this->_em->flush();
    }

    public function removeAllTokens()
    {
        $tokens = $this->findAll();
        foreach ($tokens as $token){
            $this->_em->remove($token);
            $this->_em->flush();
        }
    }

    public function clearTable()
    {
        $connection = $this->_em->getConnection();
        $connection->executeQuery('SET FOREIGN_KEY_CHECKS = 0;');
        $platform   = $connection->getDatabasePlatform();

        $connection->executeUpdate($platform->getTruncateTableSQL('group_discipline_marks', true));
        $connection->executeQuery('SET FOREIGN_KEY_CHECKS = 1;');
    }
}

