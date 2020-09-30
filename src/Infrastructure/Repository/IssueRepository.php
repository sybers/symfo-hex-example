<?php

namespace App\Infrastructure\Repository;

use App\Application\Repository\IssueRepositoryInterface;
use App\Domain\Entity\Issue;
use App\Domain\Exception\EntityNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class IssueRepository extends ServiceEntityRepository implements IssueRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Issue::class);
    }

    public function findAll(string $order = 'title'): array
    {
        $qb = $this->createQueryBuilder('i')
            ->orderBy("i.$order", "ASC");

        return $qb->getQuery()->getResult();
    }

    public function findByID(int $id): Issue
    {
        $issue = $this->find($id);

        if (null === $issue) {
            throw new EntityNotFoundException();
        }

        return $issue;
    }
}
