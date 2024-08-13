<?php

namespace App\Services\Api\User\Auth;

use App\Bases\Auth\AuthBase;
use Illuminate\Support\Facades\Auth;

class ApiAuthService extends AuthBase
{
    protected string $model = 'App\\Models\\User\\User';
    protected string $guard = 'sanctum';
    protected string $column = 'phone';
    protected string $imageKey = "image";

}
