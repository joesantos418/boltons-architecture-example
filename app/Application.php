<?php

namespace Arquivei\Boltons\App\Example;

use Arquivei\Boltons\App\Example\Adapters\DatabaseAdapter;
use Arquivei\Boltons\Example\Modules\User\Creation\Exceptions\EmailTakenException;
use Arquivei\Boltons\Example\Modules\User\Creation\Exceptions\UserSaveException;
use Arquivei\Boltons\Example\Modules\User\Creation\UseCase;

class Application
{
    public function saveUser(
        string $name,
        string $email,
        string $phone
    ) {
        $request = new Request($name, $email, $phone);
        $useCase = new UseCase(new DatabaseAdapter(), new DatabaseAdapter());

        try {
            $response = $useCase->execute($request);
        } catch (EmailTakenException $e) {
            echo sprintf("E-mail %s is already taken\n", $email);
            exit(1);
        } catch (UserSaveException $u) {
            echo sprintf("User cannot be saved with message: %s\n", $u->getPrevious()->getMessage());
            exit(1);
        }

        echo sprintf("User saved with the id %s\n", $response->getUserId());
        exit(0);
    }
}
