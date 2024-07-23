<?php

namespace App\Bases\Auth;

use App\Trait\ApiResponse;
use App\Trait\UserAuthentication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthBase
{
    use UserAuthentication;

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
    public function register(array $request)
    {
        return  $this->model::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => hashUserPassword($request['password']),
            'phone' => $request['phone'],
            'image' => uploadImage($request, 'image', 'users'),
        ]);
    }

    public function logout()
    {
        $user = $this->getAuthenticatedUser();
        $user->update(["api_token" => null]);
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
}
