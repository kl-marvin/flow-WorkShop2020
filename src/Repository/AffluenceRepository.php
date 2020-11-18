<?php

namespace App\Repository;

use App\Entity\Affluence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Affluence|null find($id, $lockMode = null, $lockVersion = null)
 * @method Affluence|null findOneBy(array $criteria, array $orderBy = null)
 * @method Affluence[]    findAll()
 * @method Affluence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AffluenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Affluence::class);
    }


    public function findDataByStructureId(int $id)
    {

        $qb = $this->createQueryBuilder('a'); // QueryBuilder a réutiliser

        $qb->andWhere('a.structure = :id')
            ->setParameter('id', $id) // évite les injections SQL
            ->orderBy('a.startTime', 'ASC'); // on récupère la date de création du créneau dans l'ordre


        return $qb->getQuery()->getResult();



    }

    // /**
    //  * @return Affluence[] Returns an array of Affluence objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Affluence
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
