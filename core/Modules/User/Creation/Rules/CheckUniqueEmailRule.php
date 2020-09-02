<?php

namespace Arquivei\Boltons\Example\Modules\User\Creation\Rules;

use Arquivei\Boltons\Example\Modules\User\Creation\Exceptions\EmailTakenException;
use Arquivei\Boltons\Example\Modules\User\Creation\Gateways\CheckUniqueEmailGateway;

class CheckUniqueEmailRule
{
    private $checkUniqueEmailGateway;
    private $email;

    public function __construct(
        CheckUniqueEmailGateway $checkUniqueEmailGateway,
        string $email
    ) {
        $this->checkUniqueEmailGateway = $checkUniqueEmailGateway;
        $this->email = $email;
    }

    public function apply(): void
    {
        if ($this->checkUniqueEmailGateway->isEmailTaken($this->email)) {
            throw new EmailTakenException(
                sprintf('The e-mail %s is already taken', $this->email)
            );
        }
    }
}
