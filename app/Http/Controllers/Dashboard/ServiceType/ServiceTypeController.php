<?php

namespace App\Http\Controllers\Dashboard\ServiceType;

use Illuminate\Http\Request;
use App\Trait\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Services\ServiceType\ServiceTypeService;
use App\Http\Requests\Dashboard\ServiceType\ServiceTypeRequest;
use App\Http\Resources\Dashboard\ServiceType\ServiceTypeResource;
use App\Http\Resources\Dashboard\ServiceType\ShowServiceTypeResource;

class ServiceTypeController extends Controller
{
    use ApiResponseTrait;

    public function __construct(private ServiceTypeService $adminService)
    {
    }
    public function index()
    {
        try {
            $admins = $this->adminService->getServiceTypes();
            $response = ServiceTypeResource::collection($admins)->response()->getData(true);
            return $this->dataResponse('fetch all service types', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function show(int $admin)
    {
        try {
            $row = $this->adminService->showServiceType($admin);
            $response = new ShowServiceTypeResource($row);
            return $this->dataResponse('show service type', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function store(ServiceTypeRequest $request)
    {
        try {
            $admin = $this->adminService->storeServiceType(dataRequest: $request);
            return $this->dataResponse(__('message.success_create'),  new ServiceTypeResource($admin), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function update(ServiceTypeRequest $request, int $admin)
    {
        try {
            $admin = $this->adminService->updateServiceType(dataRequest: $request, id: $admin);
            return $this->dataResponse(__('message.success_update'),  new ServiceTypeResource($admin), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->adminService->deleteServiceType($id);
            $msg = __('message.success_delete');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
