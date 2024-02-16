<?php

namespace App\Application\Command;

use App\Domain\Entity\User;

final class CreateIssueCommand
{
    private User $createdBy;

    private string $title;

    private string $content;

    public function __construct(User $createdBy, string $title, string $content)
    {
        $this->createdBy = $createdBy;
        $this->title = $title;
        $this->content = $content;
    }

    public function getCreatedBy(): User
    {
        return $this->createdBy;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
