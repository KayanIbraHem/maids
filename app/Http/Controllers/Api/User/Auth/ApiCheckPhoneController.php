<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Models\User\User;
use App\Trait\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Auth\ApiCheckPhoneRequest;

class ApiCheckPhoneController extends Controller
{
    use ApiResponse;

    public function __invoke(ApiCheckPhoneRequest $request)
    {
        try {
            $user = User::checkPhone($request->phone);
            return $this->dataResponse(__('message.success_check_phone'), $user, 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
