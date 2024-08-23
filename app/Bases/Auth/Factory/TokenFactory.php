<?php

namespace App\Bases\Auth\Factory;

use App\Bases\Auth\Const\GuardType;
use App\Bases\Auth\Interfaces\UserToken;
use App\Bases\Auth\Guards\AdminDashboard;
use App\Bases\Auth\Guards\ApiMobileSanctum;

final class TokenFactory
{
    public static function checkGuard(string $guard): UserToken
    {
        return  match ($guard) {
            GuardType::ADMIN => new AdminDashboard(),
            GuardType::SANCTUM => new ApiMobileSanctum(),
            default => throw new \InvalidArgumentException("Invalid guard: $guard"),
        };
    }
}
