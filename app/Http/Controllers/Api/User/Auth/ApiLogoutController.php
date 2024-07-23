<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Api\User\Auth\ApiAuthService;

class ApiLogoutController extends Controller
{
    use ApiResponse;
    public function __construct(private ApiAuthService $apiAuthService)
    {
    }
    public function logout()
    {
        try {
            $this->apiAuthService->logout();
            $msg = __('auth.success_logout');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
