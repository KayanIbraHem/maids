<?php

namespace App\Bases\Auth\Trait;

use Illuminate\Database\Eloquent\Model;

trait TokenHandle
{
    public  function generateApiToken()
    {
        return hashApiToken();
    }
    public  function generateUserApiToken(Model $model, string $name)
    {
        return userApiToken($model, $name);
    }
    protected function removeAllToken(Model $model)
    {
        $model->tokens()->delete();
    }
    protected function removeCurrentToken(Model $model)
    {
        $model->currentAccessToken()->delete();
    }
}
