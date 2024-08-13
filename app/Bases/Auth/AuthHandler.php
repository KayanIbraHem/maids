<?php

namespace App\Bases\Auth;

use App\Trait\FileHandle;
use Illuminate\Support\Facades\Auth;
use App\Bases\Auth\Trait\TokenHandle;
use Illuminate\Database\Eloquent\Model;
use App\Bases\Auth\Factory\TokenFactory;
use App\Bases\Auth\Trait\UserAuthentication;

abstract class AuthHandler
{
    use FileHandle, TokenHandle, UserAuthentication;

    protected string $model;
    protected string $guard;
    protected string $column;
    protected string $imageKey = "";

    public function setModel(string $model): void
    {
        $this->model = $model;
    }
    public function getGuard(): string
    {
        return $this->guard;
    }

    abstract public function login(object $request): Model;

    abstract public function register(array $dataRequest): Model;

    protected function loginHandle(object $request): Model
    {
        $user = $this->getRow($request[$this->column]);
        $this->validatePassword($request['password'], $user);
        $this->setUserToken($user);

        return $user;
    }
    protected function registerHandle(array $dataRequest): array
    {
        $data = $dataRequest;
        $image = $this->prepareImage($dataRequest);
        if ($image) $data[$this->imageKey] = $image;

        return $data;
    }
    public function changePassword(object $request)
    {
        $user = $this->getAuthenticatedUser($this->guard);
        $this->newPassword($request, $user);

        return $user;
    }
    public function resetPassword(object $request)
    {
        $user = $this->getRow($request[$this->column]);
        $this->updatePassword($request->password, $user);
        $this->regenerateUserApiToken($user);

        return $user;
    }
    protected function newPassword(object $request, Model $user)
    {
        $this->validatePassword($request->old_password, $user);
        $this->updatePassword($request->new_password, $user);

        return $user;
    }
    protected function updatePassword($password, Model $user): Model
    {
        $user->update([
            'password' => hashUserPassword($password),
        ]);

        return $user;
    }
    public function logout()
    {
        $user = $this->getAuthenticatedUser($this->guard);
        $this->removeUserToken($user);
    }
    protected  function regenerateUserApiToken(Model $model)
    {
        $this->removeAllToken($model);
        $this->setUserToken($model);
    }
    protected function setUserToken(Model $user)
    {
        TokenFactory::checkGuard($this->guard)->setToken($user);
    }
    protected function removeUserToken(Model $user)
    {
        TokenFactory::checkGuard($this->guard)->removeToken($user);
    }
    protected function getRow(string $column)
    {
        $row = $this->model::where($this->column, $column)->first();
        if (!$row) {
            throw new \Exception(__('auth.email_not_found'));
        }

        return $row;
    }
}
