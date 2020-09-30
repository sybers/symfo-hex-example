<?php

namespace App\Application\Query;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use App\Domain\Entity\Issue;

final class CreateIssueQueryHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(CreateIssueQuery $query)
    {
        $issue = new Issue();

        $issue->setTitle($query->getTitle());
        $issue->setContent($query->getContent());

        $this->entityManager->persist($issue);
        $this->entityManager->flush();
    }
}
