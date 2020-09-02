<?php

namespace Arquivei\Boltons\Example\Modules\User\Creation\Gateways;

use Arquivei\Boltons\Example\Modules\User\Creation\Entities\User;

interface UserSaveGateway
{
    public function save(User $user): string;
}
