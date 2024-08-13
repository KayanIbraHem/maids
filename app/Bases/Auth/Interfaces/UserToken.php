<?php

namespace App\Bases\Auth\Interfaces;

interface UserToken
{
    public function setToken($user): void;
    public function removeToken($user): void;
}
