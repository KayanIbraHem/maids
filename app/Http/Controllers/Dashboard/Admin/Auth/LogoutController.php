<?php

namespace App\Http\Controllers\Dashboard\Admin\Auth;

use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Dashboard\Admin\AdminResource;
use App\Http\Requests\Dashboard\Admin\Auth\LoginRequest;
use App\Services\Dashboard\Admin\AuthService;

class LogoutController extends Controller
{
    use ApiResponse;
    public function __construct(private AuthService $authService) {}
    public function logout()
    {
        try {
            $admin = $this->authService->logout();
            $msg = __('auth.success_logout');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
