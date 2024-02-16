<?php

namespace App\Application\Query;

use App\Domain\Entity\User;

final class ListIssuesForUserQuery
{
    private User $createdBy;

    private string $order;

    public function __construct(User $createdBy, string $order = 'title')
    {
        $this->createdBy = $createdBy;
        $this->order = $order;
    }

    public function getCreatedBy(): User
    {
        return $this->createdBy;
    }

    public function getOrder(): string
    {
        return $this->order;
    }
}
