<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\AdminType;
use Illuminate\Http\Request;
use App\Trait\ApiResponseTrait;
use Symfony\Component\HttpFoundation\Response;

class SuperAdmin
{
    use ApiResponseTrait;

    public function handle(Request $request, Closure $next): Response
    {
        try {
            $admin = Auth('admin')->user();
            if ($admin != null && $admin->type === AdminType::SUPER_ADMIN->value) {
                return $next($request);
            }
            return $this->errorResponse(__('auth.permission_denied'), 401);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 401);
        }
    }
}
