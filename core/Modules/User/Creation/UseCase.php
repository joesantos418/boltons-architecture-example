<?php

namespace Arquivei\Boltons\Example\Modules\User\Creation;

use Arquivei\Boltons\Example\Modules\User\Creation\Gateways\CheckUniqueEmailGateway;
use Arquivei\Boltons\Example\Modules\User\Creation\Gateways\UserSaveGateway;
use Arquivei\Boltons\Example\Modules\User\Creation\Requests\Request;
use Arquivei\Boltons\Example\Modules\User\Creation\Responses\Response;
use Arquivei\Boltons\Example\Modules\User\Creation\Rules\CheckUniqueEmailRule;
use Arquivei\Boltons\Example\Modules\User\Creation\Rules\UserSaveRule;
use Arquivei\Boltons\Example\Modules\User\Creation\Rulesets\Ruleset;

class UseCase
{
    private $checkUniqueEmailGateway;
    private $userSaveGateway;

    public function __construct(
        CheckUniqueEmailGateway $checkUniqueEmailGateway,
        UserSaveGateway $userSaveGateway
    ) {
        $this->checkUniqueEmailGateway = $checkUniqueEmailGateway;
        $this->userSaveGateway = $userSaveGateway;
    }

    public function execute(Request $request): Response
    {
        $ruleset = new Ruleset(
            new CheckUniqueEmailRule(
                $this->checkUniqueEmailGateway,
                $request->getUser()->getEmail()
            ),
            new UserSaveRule(
                $this->userSaveGateway,
                $request->getUser()
            )
        );

        return $ruleset->apply();
    }
}
