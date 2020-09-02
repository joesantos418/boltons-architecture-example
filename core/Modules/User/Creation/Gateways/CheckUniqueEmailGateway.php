<?php

namespace Arquivei\Boltons\Example\Modules\User\Creation\Gateways;

interface CheckUniqueEmailGateway
{
    public function isEmailTaken(string $email): bool;
}
