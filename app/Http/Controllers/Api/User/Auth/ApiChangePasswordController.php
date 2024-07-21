<?php

namespace App\Http\Controllers\Api\User\Auth;

use Illuminate\Http\Request;
use App\Trait\ApiResponse;
use App\Services\Admin\AuthService;
use App\Http\Controllers\Controller;
use App\Services\User\Auth\ApiAuthService;
use App\Http\Resources\Api\User\Auth\ApiUserResource;
use App\Http\Resources\Dashboard\Admin\AdminResource;
use App\Http\Requests\Dashboard\Admin\Auth\ChangePasswordRequest;

class ApiChangePasswordController extends Controller
{
    use ApiResponse;

    public function __construct(private ApiAuthService $apiAuthService)
    {
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $admin = $this->apiAuthService->changePassword($request);
            $msg = __('auth.success_change_password');
            $data = new ApiUserResource($admin);
            return $this->dataResponse($msg, $data, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
