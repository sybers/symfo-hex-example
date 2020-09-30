<?php

namespace App\Application\Query;

use App\Application\Repository\IssueRepositoryInterface;
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
        return $this->issueRepository->findByID($query->getID());
    }
}
