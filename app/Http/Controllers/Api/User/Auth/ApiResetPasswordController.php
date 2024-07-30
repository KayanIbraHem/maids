<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Trait\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Api\User\Auth\ApiAuthService;
use App\Http\Resources\Api\User\Auth\ApiUserResource;
use App\Http\Requests\Api\User\Auth\ApiResetPasswordRequest;

class ApiResetPasswordController extends Controller
{
    use ApiResponse;
    public function __construct(private ApiAuthService $apiAuthService)
    {
    }
    public function resetPassword(ApiResetPasswordRequest $request)
    {
        try {
            $this->apiAuthService->resetPassword($request);
            $msg = __('auth.success_reset_password');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
