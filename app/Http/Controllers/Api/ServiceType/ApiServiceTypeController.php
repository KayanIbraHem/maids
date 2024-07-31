<?php

namespace App\Http\Controllers\Api\ServiceType;

use App\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Api\ServiceType\ApiServiceTypeService;
use App\Http\Resources\Api\ServiceType\ApiServiceTypeResource;
use App\Http\Requests\Api\ServiceType\ApiFetchServiceTypeByIdRequest;

class ApiServiceTypeController extends Controller
{
    use ApiResponse;
    public function __construct(private ApiServiceTypeService $apiServiceTypeService)
    {
    }
    public function serviceTypes()
    {
        try {
            $serviceTypes = $this->apiServiceTypeService->fetchList();
            $response = ApiServiceTypeResource::collection($serviceTypes);
            return $this->dataResponse('fetch all service types', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function fetchServiceTypeById(ApiFetchServiceTypeByIdRequest $request)
    {
        try {
            $serviceType = $this->apiServiceTypeService->fetchById($request->service_type_id);
            $response = new ApiServiceTypeResource($serviceType);
            return $this->dataResponse('fetch service type', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
