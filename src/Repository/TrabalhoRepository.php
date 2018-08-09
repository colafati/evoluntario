<?php

namespace App\Repository;

use App\Entity\Trabalho;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Trabalho|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trabalho|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trabalho[]    findAll()
 * @method Trabalho[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrabalhoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Trabalho::class);
    }

//    /**
//     * @return Trabalho[] Returns an array of Trabalho objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Trabalho
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
