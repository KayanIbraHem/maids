<?php

namespace App\Http\Controllers\Dashboard\ServiceType;

use Illuminate\Http\Request;
use App\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\ServiceType\ServiceTypeService;
use App\Http\Requests\Dashboard\ServiceType\ServiceTypeRequest;
use App\Http\Resources\Dashboard\ServiceType\ServiceTypeResource;
use App\Http\Resources\Dashboard\ServiceType\ShowServiceTypeResource;

class ServiceTypeController extends Controller
{
    use ApiResponse;

    public function __construct(private ServiceTypeService $serviceTypeService)
    {
    }
    public function index()
    {
        try {
            $serviceTypes = $this->serviceTypeService->index();
            $response = ServiceTypeResource::collection($serviceTypes)->response()->getData(true);
            return $this->dataResponse('fetch all service types', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function show(int $id)
    {
        try {
            $row = $this->serviceTypeService->show($id);
            $response = new ShowServiceTypeResource($row);
            return $this->dataResponse('show service type', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function store(ServiceTypeRequest $request)
    {
        try {
            $serviceType = $this->serviceTypeService->store(dataRequest: $request->validated());
            return $this->dataResponse(__('message.success_create'),  new ServiceTypeResource($serviceType), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function update(ServiceTypeRequest $request, int $id)
    {
        try {
            $serviceType = $this->serviceTypeService->update(dataRequest: $request->validated(), id: $id);
            return $this->dataResponse(__('message.success_update'),  new ServiceTypeResource($serviceType), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->serviceTypeService->delete($id);
            $msg = __('message.success_delete');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
