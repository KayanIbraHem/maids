<?php

namespace App\Http\Controllers\Dashboard\NationalityType;

use App\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\NationalityType\NationalityTypeService;
use App\Http\Resources\Dashboard\NationalityType\NationalityTypeResource;
use App\Http\Requests\Dashboard\NationalityType\StoreNationalityTypeRequest;
use App\Http\Requests\Dashboard\NationalityType\UpdateNationalityTypeRequest;
use App\Http\Resources\Dashboard\NationalityType\ShowNationalityTypeResource;

class NationalityTypeController extends Controller
{
    use ApiResponse;
    public function __construct(protected NationalityTypeService $nationalityTypeService)
    {
    }
    public function index()
    {
        try {
            $nationalityTypes = $this->nationalityTypeService->index();
            $response = NationalityTypeResource::collection($nationalityTypes)->response()->getData(true);
            return $this->dataResponse('fetch all nationality types', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function show(int $id)
    {
        try {
            $nationalityType = $this->nationalityTypeService->show($id);
            $response = new ShowNationalityTypeResource($nationalityType);
            return $this->dataResponse('show nationality type', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function store(StoreNationalityTypeRequest $request)
    {
        try {
            $nationalityType = $this->nationalityTypeService->store(dataRequest: $request->validated());
            return $this->dataResponse(__('message.success_create'),  new NationalityTypeResource($nationalityType), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function update(UpdateNationalityTypeRequest $request, int $id)
    {
        try {
            $nationalityType = $this->nationalityTypeService->update(dataRequest: $request->validated(), id: $id);
            return $this->dataResponse(__('message.success_update'),  new NationalityTypeResource($nationalityType), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->nationalityTypeService->delete($id);
            $msg = __('message.success_delete');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
