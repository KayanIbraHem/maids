<?php

namespace App\Http\Controllers\Dashboard\Policy;

use Illuminate\Http\Request;
use App\Models\Policy\Policy;
use App\Trait\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Policy\PolicyRequest;
use App\Services\Policy\PolicyService;
use App\Http\Resources\Dashboard\Policy\PolicyResource;
use App\Http\Resources\Dashboard\Policy\ShowPolicyResource;

class PolicyController extends Controller
{
    use ApiResponseTrait;
    public function __construct(private PolicyService $policyService)
    {
    }
    public function index()
    {
        try {
            $policies = $this->policyService->index();
            $response = PolicyResource::collection($policies)->response()->getData(true);
            return $this->dataResponse('fetch all policies', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function show(int $id)
    {
        try {
            $row = $this->policyService->show($id);
            $response = new ShowPolicyResource($row);
            return $this->dataResponse('show policy', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function store(PolicyRequest $request)
    {
        try {
            $policy = $this->policyService->store(data: $request->validated());
            return $this->dataResponse(__('message.success_create'),  new PolicyResource($policy), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function update(PolicyRequest $request, int $id)
    {
        try {
            $policy = $this->policyService->update(data: $request->validated(), id: $id);
            return $this->dataResponse(__('message.success_update'),  new PolicyResource($policy), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->policyService->delete($id);
            $msg = __('message.success_delete');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
