<?php
namespace App\Repositories;
use App\Constants;
use App\Entities\Department;
use App\Entities\Group;
use App\Entities\GroupDisciplineMarks;
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
 * Class GroupDisciplineMarksRepo
 * @package App\Repositories
 */
class GroupDisciplineMarksRepo extends EntityRepository {

    /**
     * @var string
     */
    private $class = 'App\Entities\GroupDisciplineMarks';

    public function saveGroupDisciplineMarks(array $studentData, User $user, Group $group, Subject $subject, int $number)
    {

        $qb = $this->createQueryBuilder('dm');
        $qb->join('dm.group', 'g')
            ->join('dm.subject', 's')
            ->where($qb->expr()->eq('g.id', $group->getId()))
            ->andWhere($qb->expr()->eq('s.id', $subject->getId()));

        $oldRecords = $qb->getQuery()->getResult();
        foreach ($oldRecords as $oldRecord){
            $this->_em->remove($oldRecord);
        }

        $this->_em->flush();

        $groupDiscipline = new GroupDisciplineMarks();
        $groupDiscipline->setGeneratedAt(date("Y-m-d H:i"));
        $groupDiscipline->setGroup($group);
        $groupDiscipline->setSubject($subject);
        $groupDiscipline->setStudentData(json_encode($studentData));
        $groupDiscipline->setNumber($number);
        $groupDiscipline->setUser($user);
        $this->_em->persist($groupDiscipline);
        $this->_em->flush();
        return $groupDiscipline;
    }
    public function getGroupDisciplineMarks(Group $group)
    {
        $qb = $this->createQueryBuilder('dm');
        $qb->join('dm.group', 'g')
            ->where($qb->expr()->eq('g.id', $group->getId()));

        $dms = $qb->getQuery()->getResult();
        $result = [];
        foreach ($dms as $dm) {
            $result[] = $dm->getArrayData();
        }
        return $result;
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

