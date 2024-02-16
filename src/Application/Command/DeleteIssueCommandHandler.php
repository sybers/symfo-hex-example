<?php

namespace App\Application\Command;

use App\Application\Repository\IssueRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class DeleteIssueCommandHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $entityManager;

    private IssueRepositoryInterface $issueRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        IssueRepositoryInterface $issueRepository
    ) {
        $this->entityManager = $entityManager;
        $this->issueRepository = $issueRepository;
    }

    public function __invoke(DeleteIssueCommand $command)
    {
        $issue = $this->issueRepository->findByID($command->getId());

        if ($issue->getCreatedBy()->getId() !== $command->getCreatedBy()->getId()) {
            throw new \Exception('User is not allowed to delete this issue.');
        }

        $this->entityManager->remove($issue);
        $this->entityManager->flush();
    }
}
