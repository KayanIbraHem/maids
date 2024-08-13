<?php

namespace App\Bases\Auth\Factory;

use App\Bases\Auth\Interfaces\UserToken;
use App\Bases\Auth\Guards\AdminDashboard;
use App\Bases\Auth\Guards\ApiMobileSanctum;

final class TokenFactory
{
    public static function checkGuard(string $guard): UserToken
    {
        return  match ($guard) {
            'admin' => new AdminDashboard(),
            'sanctum' => new ApiMobileSanctum(),
            default => throw new \InvalidArgumentException("Invalid guard: $guard"),
        };
    }
}
