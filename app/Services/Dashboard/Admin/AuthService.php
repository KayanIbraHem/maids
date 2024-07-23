<?php

namespace App\Services\Dashboard\Admin;

use App\Bases\Auth\AuthBase;

class AuthService extends AuthBase
{
    protected string $model = 'App\\Models\\Admin\\Admin';

    protected string $guard = 'admin';
}
