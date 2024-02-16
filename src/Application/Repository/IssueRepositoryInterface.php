<?php

namespace App\Application\Repository;

use App\Domain\Entity\Issue;
use App\Domain\Entity\User;

interface IssueRepositoryInterface
{
    public function findByUser(User $createdBy, string $order = 'title'): array;

    public function findByID(int $id): Issue;
}
