<?php

namespace App\Application\Query;

use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use App\Application\Repository\IssueRepositoryInterface;

class ListIssuesForUserQueryHandler implements MessageHandlerInterface
{
    private IssueRepositoryInterface $issueRepository;

    public function __construct(IssueRepositoryInterface $issueRepository)
    {
        $this->issueRepository = $issueRepository;
    }

    public function __invoke(ListIssuesForUserQuery $query)
    {
        return $this->issueRepository->findByUser($query->getCreatedBy(), $query->getOrder());
    }
}
