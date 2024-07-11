<?php

namespace App\Http\Controllers\Dashboard\Admin\Auth;

use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Trait\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Dashborad\Admin\AdminResource;
use App\Http\Requests\Dashboard\Admin\Auth\LoginRequest;

class LoginController extends Controller
{
    use ApiResponseTrait;
    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            $admin = Admin::whereEmail($credentials['email'])->first();
            if (!$admin) {
                $msg = __('auth.email_not_found');
                return $this->errorResponse($msg, 402);
            }
            if ($admin != null && Hash::check($credentials['password'], $admin->password)) {
                $admin->update([
                    "api_token" => hashApiToken()
                ]);
                $msg = __('auth.success_login');
                $data = new AdminResource($admin);
                return $this->dataResponse($msg, $data, 200);
            } else {
                $msg = __('auth.credentials_incorrect');

                return $this->errorResponse($msg, 401);
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
