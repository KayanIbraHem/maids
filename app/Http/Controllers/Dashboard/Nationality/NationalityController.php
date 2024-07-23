<?php

namespace App\Http\Controllers\Dashboard\Nationality;

use Illuminate\Http\Request;
use App\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Nationality\Nationality;
use App\Services\Dashboard\Nationality\NationalityService;
use App\Http\Requests\Dashboard\Nationality\NationalityRequest;
use App\Http\Resources\Dashboard\Nationality\NationalityResource;
use App\Http\Resources\Dashboard\Nationality\ShowNationalityResource;

class NationalityController extends Controller
{
    use ApiResponse;

    public function __construct(private NationalityService $nationalityService)
    {
    }
    public function index()
    {
        try {
            $admins = $this->nationalityService->index();
            $response = NationalityResource::collection($admins)->response()->getData(true);
            return $this->dataResponse('fetch all nationalities', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function show(int $id)
    {
        try {
            $row = $this->nationalityService->show($id);
            $response = new ShowNationalityResource($row);
            return $this->dataResponse('show nationality', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function store(NationalityRequest $request)
    {
        try {
            $admin = $this->nationalityService->store(data: $request->validated());
            return $this->dataResponse(__('message.success_create'),  new NationalityResource($admin), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function update(NationalityRequest $request, int $id)
    {
        try {
            $admin = $this->nationalityService->update(data: $request->validated(), id: $id);
            return $this->dataResponse(__('message.success_update'),  new NationalityResource($admin), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->nationalityService->delete($id);
            $msg = __('message.success_delete');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
