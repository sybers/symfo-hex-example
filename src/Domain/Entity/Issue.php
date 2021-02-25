<?php

namespace App\Domain\Entity;

class Issue
{
    protected ?int $id;

    protected ?User $createdBy;

    protected ?string $title;

    protected ?string $content;

    public function getID(): ?int
    {
        return $this->id;
    }

    public function setID(?int $id): void
    {
        $this->id = $id;
    }

    public function getCreatedBy(): ?User {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $user): void {
        $this->createdBy = $user;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): void
    {
        $this->content = $content;
    }
}
