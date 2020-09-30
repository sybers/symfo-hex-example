<?php

namespace App\Application\Command;

final class DeleteIssueCommand
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}
