<?php

namespace Arquivei\Boltons\App\Example\Adapters;

class DatabaseAdapter implements CheckUniqueEmailGateway, UserSaveGateway
{
    private $takenEmails = ['test@test.com', 'newtest@test.com'];

    public function save(User $user): string
    {
        if (((int) date('s')) % 2 == 1) {
            throw new \Exception('Cannot save user because the current time is odd');
        }

        return date('is');
    }

    public function isEmailTaken(string $email): bool
    {
        return in_array($email, $this->takenEmails);
    }
}
