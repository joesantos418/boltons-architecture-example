<?php

namespace Arquivei\Boltons\Example\Modules\User\Creation\Rules;

use Arquivei\Boltons\Example\Modules\User\Creation\Entities\User;
use Arquivei\Boltons\Example\Modules\User\Creation\Exceptions\UserSaveException;
use Arquivei\Boltons\Example\Modules\User\Creation\Gateways\UserSaveGateway;

class UserSaveRule
{
    private $userSaveGateway;
    private $user;

    public function __construct(
        UserSaveGateway $userSaveGateway,
        User $user
    ) {
        $this->userSaveGateway = $userSaveGateway;
        $this->user = $user;
    }

    public function apply(): string
    {
        try {
            return $this->userSaveGateway->save($this->user);
        } catch (\Throwable $t) {
            throw new UserSaveException('Error saving user', 500, $t);
        }
    }
}
