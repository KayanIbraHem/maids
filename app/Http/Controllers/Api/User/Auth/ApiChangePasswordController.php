<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Api\User\Auth\ApiAuthService;
use App\Http\Resources\Api\User\Auth\ApiUserResource;
use App\Http\Requests\Api\User\Auth\ApiChangePasswordRequest;

class ApiChangePasswordController extends Controller
{
    use ApiResponse;

    public function __construct(private ApiAuthService $apiAuthService)
    {
    }

    public function changePassword(ApiChangePasswordRequest $request)
    {
        try {
            $user = $this->apiAuthService->changePassword($request);
            $msg = __('auth.success_change_password');
            $data = new ApiUserResource($user);
            return $this->dataResponse($msg, $data, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
