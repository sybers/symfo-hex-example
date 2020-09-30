<?php

namespace App\Application\Query;

final class GetIssueByIDQuery
{
    private int $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getID(): int
    {
        return $this->id;
    }
}
