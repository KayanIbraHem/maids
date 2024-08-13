<?php

namespace App\Bases\Auth\Guards;

use App\Bases\Auth\Trait\TokenHandle;
use App\Bases\Auth\Interfaces\UserToken;

class AdminDashboard implements UserToken
{
    use TokenHandle;
    public function setToken($user): void
    {
        $user->update(['api_token' => $this->generateApiToken($user, 'admin-dashboard')]);
    }
    public function removeToken($user): void
    {
        $user->update(['api_token' => null]);
    }
}
