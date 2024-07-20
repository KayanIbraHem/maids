<?php

namespace App\Http\Controllers\Dashboard\Admin\Auth;

use Illuminate\Http\Request;
use App\Trait\ApiResponseTrait;
use App\Services\Admin\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Admin\AdminResource;
use App\Http\Requests\Dashboard\Admin\Auth\ChangePasswordRequest;

class ChangePasswordController extends Controller
{
    use ApiResponseTrait;

    public function __construct(private AuthService $authService)
    {
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $admin = $this->authService->changePassword($request);
            $msg = __('auth.success_change_password');
            $data = new AdminResource($admin);
            return $this->dataResponse($msg, $data, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
