<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Car>
 *
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

//    /**
//     * @return Car[] Returns an array of Car objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    /**
     * @return Car[] Returns an array of Car objects
     */
    public function getFilteredList_paginate( $filterArray,$limit,$offset,$sortBy ): array
    {
        $query =  $this->createQueryBuilder('car')
            ->select('car.id','brand.name as brand_name','car.name','car.gasEconomyRate')
            ->join('car.brand','brand');

        foreach ($filterArray as $filter)
        {
            if($filter['val']){
                $query = $query->andWhere($filter['name'] ." = '".$filter['val']."'");
            }
        }

        $query = $query
            ->orderBy($sortBy, 'ASC')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult() ;
        return $query;
    }

    /**
     * @return Car[] Returns an array of Car objects
     */
    public function getFiltered_count( $filterArray ): int
    {
        $query =  $this->createQueryBuilder('car')
            ->select('count(car.id)' )
            ->join('car.brand','brand');

        foreach ($filterArray as $filter)
        {
            if($filter['val']){
                $query = $query->andWhere($filter['name'] ." = '".$filter['val']."'");
            }
        }

        $query = $query
            ->getQuery()
            ->getSingleScalarResult();
        return $query;
    }

//    public function findOneBySomeField($value): ?Car
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
