<?php

namespace App\Application\Query;

use App\Application\Repository\IssueRepositoryInterface;
use App\Domain\Exception\NotAllowedException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class GetIssueByIDQueryHandler implements MessageHandlerInterface
{
    private IssueRepositoryInterface $issueRepository;

    public function __construct(IssueRepositoryInterface $issueRepository)
    {
        $this->issueRepository = $issueRepository;
    }

    public function __invoke(GetIssueByIDQuery $query)
    {
        $issue = $this->issueRepository->findByID($query->getID());

        if ($issue->getCreatedBy()->getId() !== $query->getCreatedBy()->getId()) {
            throw new NotAllowedException('Issue not created by user, unable to retrieve');
        }

        return $issue;
    }
}
