<?php

namespace App\Http\Controllers\Dashboard\Maid;

use App\Models\Maid\Maid;
use App\Trait\ApiResponse;
use App\Services\Maid\MaidService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Maid\MaidResource;
use App\Http\Requests\Dashboard\Maid\StoreMaidRequest;
use App\Http\Requests\Dashboard\Maid\UpdateMaidRequest;

class MaidController extends Controller
{
    use ApiResponse;
    public function __construct(private MaidService $maidService)
    {
    }
    public function index()
    {
        try {
            $maids = $this->maidService->index();
            $response = MaidResource::collection($maids)->response()->getData(true);
            return $this->dataResponse('fetch all maids', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function show(int $id)
    {
        try {
            $row = $this->maidService->show($id);
            $response = new MaidResource($row);
            return $this->dataResponse('show maid', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function store(StoreMaidRequest $request)
    {
        try {
            $maid = $this->maidService->store(data: $request->validated());
            return $this->dataResponse(__('message.success_create'),  new MaidResource($maid), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function update(UpdateMaidRequest $request, int $id)
    {
        try {
            $maid = $this->maidService->update(data: $request->validated(), id: $id);
            return $this->dataResponse(__('message.success_update'),  new MaidResource($maid), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->maidService->delete($id);
            $msg = __('message.success_delete');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
