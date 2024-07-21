<?php

namespace App\Http\Controllers\Dashboard\Term;

use App\Models\Term\Term;
use Illuminate\Http\Request;
use App\Trait\ApiResponse;
use App\Services\Term\TermService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Term\TermRequest;
use App\Http\Resources\Dashboard\Term\TermResource;
use App\Http\Resources\Dashboard\Term\ShowTermResource;

class TermController extends Controller
{
    use ApiResponse;
    public function __construct(private TermService $termService)
    {
    }
    public function index()
    {
        try {
            $terms = $this->termService->index();
            $response = TermResource::collection($terms)->response()->getData(true);
            return $this->dataResponse('fetch all terms', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function show(int $id)
    {
        try {
            $row = $this->termService->show($id);
            $response = new ShowTermResource($row);
            return $this->dataResponse('show term', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function store(TermRequest $request)
    {
        try {
            $term = $this->termService->store(data: $request->validated());
            return $this->dataResponse(__('message.success_create'),  new TermResource($term), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function update(TermRequest $request, int $id)
    {
        try {
            $term = $this->termService->update(data: $request->validated(), id: $id);
            return $this->dataResponse(__('message.success_update'),  new TermResource($term), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->termService->delete($id);
            $msg = __('message.success_delete');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
