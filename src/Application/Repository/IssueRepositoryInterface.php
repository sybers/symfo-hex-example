<?php

namespace App\Application\Repository;

use App\Domain\Entity\Issue;

interface IssueRepositoryInterface
{
    public function findAll(string $order = 'title'): array;

    public function findByID(int $id): Issue;
}
