<?php

namespace App\Trait;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

trait UserAuthentication
{
    protected function validateCredentials($row, string $password)
    {
        if (!Hash::check($password, $row->password)) {
            throw new \Exception(__('auth.credentials_incorrect'));
        }
    }
    protected function getAuthenticatedUser()
    {
        return Auth::guard($this->guard)->user();
    }

    protected function generateApiToken()
    {
        return hashApiToken();
    }
    protected function generateUserApiToken(Model $model, string $name)
    {
        return userApiToken($model, $name);
    }
    protected function regenerateUserApiToken(Model $model, string $name)
    {
        $model->tokens()->delete();
        return userApiToken($model, $name);
    }
}
