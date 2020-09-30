<?php

namespace App\Application\Query;

final class ListAllIssuesQuery
{
    private string $order;

    public function __construct(string $order = 'title')
    {
        $this->order = $order;
    }

    public function getOrder(): string
    {
        return $this->order;
    }
}
