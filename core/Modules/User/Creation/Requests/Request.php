<?php

namespace Arquivei\Boltons\Example\Modules\User\Creation\Requests;

use Arquivei\Boltons\Example\Modules\User\Creation\Entities\User;

class Request
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
