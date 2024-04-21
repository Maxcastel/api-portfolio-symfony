<?php

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Project>
 *
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    public function findAllProjects(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT * FROM project p
                LEFT JOIN type ON p.type_id = type.id
                LEFT JOIN project_framework pf ON p.id = pf.project_id
                LEFT JOIN framework f ON pf.framework_id = f.id
                LEFT JOIN project_language pl ON p.id = pl.project_id
                LEFT JOIN language l ON pl.language_id = l.id
                LEFT JOIN category ON p.category_id = category.id
                LEFT JOIN classe ON p.classe_id = classe.id"
        ;

        $result = $conn->executeQuery($sql);

        return $result->fetchAllAssociative();
    }

    public function findAllProjectss(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Project p
            LEFT JOIN p.type t
            LEFT JOIN p.frameworks f
            LEFT JOIN p.languages l
            LEFT JOIN p.category c
            LEFT JOIN p.classe cl'
        );
        
        return $query->getResult();
    }

    public function findAllProjectsss(): array
    {
        $qb = $this->createQueryBuilder('p');

        $qb->select('p')
            ->leftJoin('p.type', 't')
            ->leftJoin('p.frameworks', 'f', 'WITH', 'f.project = p')
            ->leftJoin('p.languages', 'l', 'WITH', 'l.project = p')
            ->leftJoin('p.category', 'c')
            ->leftJoin('p.classe', 'cl');

        $query = $qb->getQuery();

        return $query->execute();
    }


//    /**
//     * @return Project[] Returns an array of Project objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Project
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
