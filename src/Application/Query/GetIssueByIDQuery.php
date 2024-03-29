<?php

namespace App\Application\Query;

use App\Domain\Entity\User;

final class GetIssueByIDQuery
{
    private User $createdBy;

    private int $id;

    public function __construct(User $createdBy, string $id)
    {
        $this->createdBy = $createdBy;
        $this->id = $id;
    }

    public function getCreatedBy(): User
    {
        return $this->createdBy;
    }

    public function getID(): int
    {
        return $this->id;
    }
}
