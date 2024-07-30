<?php

namespace App\Services\Api\User\Auth;

use App\Bases\Auth\AuthBase;
use Illuminate\Support\Facades\Auth;

class ApiAuthService extends AuthBase
{
    protected string $model = 'App\\Models\\User\\User';
    protected string $guard = 'sanctum';
    public function login(object $request)
    {
        $credentials = $request->only('phone', 'password');
        $user = $this->getRowByPhone($credentials['phone']);
        $this->validateCredentials($user, $credentials['password']);
        $user['token'] = $this->generateUserApiToken($user, $this->guard);
        return $user;
    }
    public function register(array $request)
    {
        $user = $this->model::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => hashUserPassword($request['password']),
            'phone' => $request['phone'],
            'country_code' => $request['country_code'],
            'image' => uploadImage($request, 'image', 'users'),
        ]);
        $user['token'] = $this->generateUserApiToken($user, $this->guard);
        return $user;
    }
    public function resetPassword(object $request)
    {
        $user = $this->getRowByPhone($request->phone);
        $user->update(['password' => hashUserPassword($request->password)]);
        $this->regenerateUserApiToken($user, $this->guard);
        return $user;
    }
    public function logout()
    {
        $user = $this->getAuthenticatedUser();
        $user->currentAccessToken()->delete();
    }
}
