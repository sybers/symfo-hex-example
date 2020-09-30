<?php

namespace App\Application\Query;

use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use App\Application\Repository\IssueRepositoryInterface;

class ListAllIssuesQueryHandler implements MessageHandlerInterface
{
    private IssueRepositoryInterface $issueRepository;

    public function __construct(IssueRepositoryInterface $issueRepository)
    {
        $this->issueRepository = $issueRepository;
    }

    public function __invoke(ListAllIssuesQuery $query)
    {
        return $this->issueRepository->findAll($query->getOrder());
    }
}
