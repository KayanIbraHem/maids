<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Illuminate\Http\Request;
use App\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\Admin\AdminService;
use App\Http\Resources\Dashboard\Admin\AdminResource;
use App\Http\Requests\Dashboard\Admin\StoreAdminRequest;
use App\Http\Requests\Dashboard\Admin\UpdateAdminRequest;

class AdminController extends Controller
{
    use ApiResponse;
    public function __construct(private AdminService $adminService)
    {
    }
    public function index()
    {
        try {
            $admins = $this->adminService->index();
            $response = AdminResource::collection($admins)->response()->getData(true);
            return $this->dataResponse('fetch admins.', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function show(int $admin)
    {
        try {
            $row = $this->adminService->show($admin);
            $response = new AdminResource($row);
            return $this->dataResponse('show admin', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function store(StoreAdminRequest $request)
    {
        try {
            $admin = $this->adminService->store(dataRequest: $request->validated());
            return $this->dataResponse(__('message.success_create'),  new AdminResource($admin), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function update(UpdateAdminRequest $request, int $admin)
    {
        try {
            $admin = $this->adminService->update(dataRequest: $request->validated(), id: $admin);
            return $this->dataResponse(__('message.success_update'),  new AdminResource($admin), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->adminService->delete($id);
            $msg = __('message.success_delete');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
