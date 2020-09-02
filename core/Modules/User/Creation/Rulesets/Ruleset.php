<?php

namespace Arquivei\Boltons\Example\Modules\User\Creation\Rulesets;

use Arquivei\Boltons\Example\Modules\User\Creation\Responses\Response;
use Arquivei\Boltons\Example\Modules\User\Creation\Rules\CheckUniqueEmailRule;
use Arquivei\Boltons\Example\Modules\User\Creation\Rules\UserSaveRule;

class Ruleset
{
    private $checkUniqueEmailRule;
    private $userSaveRule;

    public function __construct(
        CheckUniqueEmailRule $checkUniqueEmailRule,
        UserSaveRule $userSaveRule
    ) {
        $this->checkUniqueEmailRule = $checkUniqueEmailRule;
        $this->userSaveRule = $userSaveRule;
    }

    public function apply(): Response
    {
        $this->checkUniqueEmailRule->apply();
        $userId = $this->userSaveRule->apply();

        return new Response($userId);
    }
}
