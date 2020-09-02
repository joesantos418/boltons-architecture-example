<?php

namespace Arquivei\Boltons\Example\Modules\User\Creation\Responses;

class Response
{
    private $userId;

    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }
}
