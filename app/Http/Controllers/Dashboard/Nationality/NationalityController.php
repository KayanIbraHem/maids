<?php

namespace App\Http\Controllers\Dashboard\Nationality;

use Illuminate\Http\Request;
use App\Trait\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\Nationality\Nationality;
use App\Http\Services\Nationality\NationalityService;
use App\Http\Requests\Dashboard\Nationality\NationalityRequest;
use App\Http\Resources\Dashboard\Nationality\NationalityResource;
use App\Http\Resources\Dashboard\Nationality\ShowNationalityResource;

class NationalityController extends Controller
{
    use ApiResponseTrait;

    public function __construct(private NationalityService $nationalityService)
    {
    }
    public function index()
    {
        try {
            $admins = $this->nationalityService->getNationalities();
            $response = NationalityResource::collection($admins)->response()->getData(true);
            return $this->dataResponse('fetch all nationalities', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function show(int $admin)
    {
        try {
            $row = $this->nationalityService->showNationality($admin);
            $response = new ShowNationalityResource($row);
            return $this->dataResponse('show nationality', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function store(NationalityRequest $request)
    {
        try {
            $admin = $this->nationalityService->storeNationality(dataRequest: $request);
            return $this->dataResponse(__('message.success_create'),  new NationalityResource($admin), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function update(NationalityRequest $request, int $admin)
    {
        try {
            $admin = $this->nationalityService->updateNationality(dataRequest: $request, id: $admin);
            return $this->dataResponse(__('message.success_update'),  new NationalityResource($admin), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->nationalityService->deleteNationality($id);
            $msg = __('message.success_delete');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
