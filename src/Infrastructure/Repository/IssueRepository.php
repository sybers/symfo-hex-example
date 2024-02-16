<?php

namespace App\Infrastructure\Repository;

use App\Application\Repository\IssueRepositoryInterface;
use App\Domain\Entity\Issue;
use App\Domain\Entity\User;
use App\Domain\Exception\EntityNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;

class IssueRepository extends ServiceEntityRepository implements IssueRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Issue::class);
    }

    public function findByUser(User $createdBy, string $order = 'title'): array
    {
        $qb = $this->createQueryBuilder('i');
        $qb->where($qb->expr()->eq("i.createdBy", $createdBy->getId()))
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
