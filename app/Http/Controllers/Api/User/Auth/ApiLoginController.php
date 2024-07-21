<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\User\Auth\ApiAuthService;
use App\Http\Requests\Api\User\Auth\ApiLoginRequest;
use App\Http\Resources\Api\User\Auth\ApiUserResource;

class ApiLoginController extends Controller
{
    use ApiResponse;
    public function __construct(private ApiAuthService $apiAuthService)
    {
    }
    public function login(ApiLoginRequest $request)
    {
        try {
            $admin = $this->apiAuthService->login($request);
            $msg = __('auth.success_login');
            $data = new ApiUserResource($admin);
            return $this->dataResponse($msg, $data, 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
