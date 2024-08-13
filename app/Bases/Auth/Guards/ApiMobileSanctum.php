<?php

namespace App\Bases\Auth\Guards;

use App\Bases\Auth\Trait\TokenHandle;
use App\Bases\Auth\Interfaces\UserToken;

class ApiMobileSanctum implements UserToken
{
    use TokenHandle;
    public function setToken($user): void
    {
        $user['token'] = $this->generateUserApiToken($user, 'api-mobile-sanctum');
    }
    public function removeToken($user): void
    {
        $this->removeCurrentToken($user);
    }
}
