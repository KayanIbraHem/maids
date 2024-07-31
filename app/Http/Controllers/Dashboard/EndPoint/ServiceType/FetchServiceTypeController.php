<?php

namespace App\Http\Controllers\Dashboard\EndPoint\ServiceType;

use App\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\ServiceType\ServiceTypeResource;
use App\Services\Dashboard\EndPoint\ServiceType\FetchServiceTypeService;

class FetchServiceTypeController extends Controller
{
    use ApiResponse;

    public function __construct(private FetchServiceTypeService $fetchServiceTypeService)
    {
    }
    public function __invoke()
    {
        try {
            $serviceTypes = $this->fetchServiceTypeService->index();
            $response = ServiceTypeResource::collection($serviceTypes);
            return $this->dataResponse('fetch all service types', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
