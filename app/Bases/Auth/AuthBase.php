<?php

namespace App\Bases\Auth;

use App\Trait\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthBase
{
    use ApiResponseTrait;

    protected string $model;
    protected string $guard;


    public function login(object $request)
    {
        $credentials = $request->only('email', 'password');
        $row = $this->getRowByEmail($credentials['email']);
        $this->validateCredentials($row, $credentials['password']);
        $row->update(['api_token' => $this->generateApiToken()]);
        return $row;
    }
    public function changePassword(object $request)
    {
        $user = $this->getAuthenticatedUser();
        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);
            return $user;
        }
        throw new \Exception(__('auth.credentials_incorrect'));
    }
    protected function getRowByEmail(string $email)
    {
        $row = $this->model::whereEmail($email)->first();
        if (!$row) {
            throw new \Exception(__('auth.email_not_found'));
        }
        return $row;
    }

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
}
