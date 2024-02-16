<?php

namespace App\Application\Command;

use App\Domain\Entity\User;

final class DeleteIssueCommand
{
    private User $createdBy;

    private int $id;

    public function __construct(User $createdBy, int $id)
    {
        $this->createdBy = $createdBy;
        $this->id = $id;
    }

    public function getCreatedBy(): User
    {
        return $this->createdBy;
    }

    public function getId()
    {
        return $this->id;
    }
}
