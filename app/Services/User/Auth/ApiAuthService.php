<?php

namespace App\Services\User\Auth;

use App\Bases\Auth\AuthBase;

class ApiAuthService extends AuthBase
{
    protected string $model = 'App\\Models\\User\\User';
    protected string $guard = 'api';
}
