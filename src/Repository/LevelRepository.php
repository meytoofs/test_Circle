<?php

namespace App\Repository;

use App\Entity\Level;
use App\Data\SearchData;
use App\Data\SearchDataType;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\QueryBuilder as ORMQueryBuilder;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Level|null find($id, $lockMode = null, $lockVersion = null)
 * @method Level|null findOneBy(array $criteria, array $orderBy = null)
 * @method Level[]    findAll()
 * @method Level[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LevelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Level::class);
        $this->paginator = $paginator;
    }
    public function getAllSVG()
    {
        $result = $this
        ->createQueryBuilder('l')
        ->select('l')
        ->join('l.noteHistories', 'n')
        ->where('n.ideaProposition = l.id')
        ->getQuery()
        ->getResult();
        return $result;

    /**
     * @return PaginationInterface
     */
    }
    public function findSearch(SearchData $search): PaginationInterface
    {
        $query = $this
        ->createQueryBuilder('l')
        ->select('l');
    if  (!empty($search->q)) {
        $query = $query
            ->andWhere('l.title LIKE :q')
            ->setParameter('q', "%{$search->q}%");
    }
    if  (!empty($search->min)) {
        $query = $query
            ->andWhere('l.total_score >= :min')
            ->setParameter('min', $search->min);
    }
    if  (!empty($search->max)) {
        $query = $query
            ->andWhere('l.total_score <= :max')
            ->setParameter('max', $search->max);
    }
    if  (($search->tri) == 1) {
        $query = $query
            ->orderBy('l.date', 'DESC');
    }
        $query = $this->getSearchQuery($search)->getQuery();
        return $this->paginator->paginate(
            $query,
            $search->page,
            27
        );
    }
    private function getSearchQuery(SearchData $search): ORMQueryBuilder
    {
        $query = $this
        ->createQueryBuilder('l')
        ->select('l');
    if  (!empty($search->q)) {
        $query = $query
            ->andWhere('l.title LIKE :q')
            ->setParameter('q', "%{$search->q}%");
    }
    if  (!empty($search->min)) {
        $query = $query
            ->andWhere('l.total_score >= :min')
            ->setParameter('min', $search->min);
    }
    if  (!empty($search->max)) {
        $query = $query
            ->andWhere('l.total_score <= :max')
            ->setParameter('max', $search->max);
    }
    if  (($search->tri) == 1) {
        $query = $query
            ->orderBy('l.date', 'DESC');
    }
        return $query;
    }
    /**
     * Récupère le score minimum et maximum correspondant a une recherche
     * @return integer[]
     */
    public function findMinMax(SearchData $search): array
    {
        $results = $this->getSearchQuery($search, true)
            ->select('MIN(l.total_score) as min', 'MAX(l.total_score) as max')
            ->getQuery()
            ->getScalarResult();
        return [(int)$results[0]['min'], (int)$results[0]['max']];
    }
    // /**
    //  * @return Level[] Returns an array of Level objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Level
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
