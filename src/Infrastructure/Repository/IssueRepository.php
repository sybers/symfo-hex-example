<?php

namespace App\Infrastructure\Repository;

use App\Application\Repository\IssueRepositoryInterface;
use App\Domain\Entity\Issue;
use App\Domain\Exception\EntityNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;

class IssueRepository extends ServiceEntityRepository implements IssueRepositoryInterface
{
    private Security $security;

    public function __construct(ManagerRegistry $registry, Security $security)
    {
        parent::__construct($registry, Issue::class);
        $this->security = $security;
    }

    public function findAll(string $order = 'title'): array
    {
        $user = $this->security->getUser();

        $qb = $this->createQueryBuilder('i');
        $qb->where($qb->expr()->eq("i.createdBy", $user->getId()))
            ->orderBy("i.$order", "ASC");

        return $qb->getQuery()->getResult();
    }

    public function findByID(int $id): Issue
    {
        $user = $this->security->getUser();
        $issue = $this->findOneBy(['id' => $id, 'createdBy' => $user->getId()]);

        if (null === $issue) {
            throw new EntityNotFoundException();
        }

        return $issue;
    }
}
