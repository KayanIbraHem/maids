<?php

namespace App\Bases\Auth\Trait;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

trait UserAuthentication
{
    public function getAuthenticatedUser($guard): ?Model
    {
        return  Auth::guard($guard)->user();
    }
    public  function validatePassword(string $password, Model $row)
    {
        if (!Hash::check($password, $row->password)) {
            throw new \Exception(__('auth.credentials_incorrect'));
        }
    }
}
