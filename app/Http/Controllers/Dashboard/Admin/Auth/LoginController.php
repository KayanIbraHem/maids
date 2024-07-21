<?php

namespace App\Http\Controllers\Dashboard\Admin\Auth;

use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Dashboard\Admin\AdminResource;
use App\Http\Requests\Dashboard\Admin\Auth\LoginRequest;
use App\Services\Admin\AuthService;

class LoginController extends Controller
{
    use ApiResponse;
    public function __construct(private AuthService $authService)
    {
    }
    public function login(LoginRequest $request)
    {
        try {
            $admin = $this->authService->login($request);
            $msg = __('auth.success_login');
            $data = new AdminResource($admin);
            return $this->dataResponse($msg, $data, 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
