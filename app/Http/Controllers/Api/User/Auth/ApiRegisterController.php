<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\User\Auth\ApiAuthService;
use App\Http\Resources\Api\User\Auth\ApiUserResource;
use App\Http\Requests\Api\User\Auth\ApiRegisterRequest;

class ApiRegisterController extends Controller
{
    use ApiResponse;
    public function __construct(private ApiAuthService $apiAuthService)
    {
    }
    public function register(ApiRegisterRequest $request)
    {
        try {
            $user = $this->apiAuthService->register($request->validated());
            $msg = __('auth.success_register');
            return $this->dataResponse($msg, new ApiUserResource($user), 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
