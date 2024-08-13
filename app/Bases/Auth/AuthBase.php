<?php

namespace App\Bases\Auth;

use App\Bases\Auth\AuthHandler;
use Illuminate\Database\Eloquent\Model;

class AuthBase extends AuthHandler
{
    public function login(object $request): Model
    {
        return $this->loginHandle($request);
    }
    public function register(array $dataRequest): Model
    {
        $data = $this->registerHandle($dataRequest);
        return $this->model::create($data);
    }
}
