<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Models\User\User;
use App\Trait\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Auth\ApiverifyPhoneRequest;

class ApiVerifyPhoneController extends Controller
{
    use ApiResponse;

    public function __invoke(ApiverifyPhoneRequest $request)
    {
        try {
            $user = User::verifyPhone($request->phone);
            return $this->dataResponse(__('message.phone_verified'), $user, 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
