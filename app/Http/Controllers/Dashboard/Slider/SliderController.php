<?php

namespace App\Http\Controllers\Dashboard\Slider;

use App\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\Slider\SliderService;
use App\Http\Resources\Dashboard\Slider\SliderResource;
use App\Http\Requests\Dashboard\Slider\StoreSliderRequest;
use App\Http\Requests\Dashboard\Slider\UpdateSliderRequest;

class SliderController extends Controller
{
    use ApiResponse;
    public function __construct(private SliderService $sliderService) {}
    public function index()
    {
        try {
            $slider = $this->sliderService->index();
            $response = SliderResource::collection($slider)->response()->getData(true);
            return $this->dataResponse('fetch all sliders', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function show(int $id)
    {
        try {
            $row = $this->sliderService->show($id);
            $response = new SliderResource($row);
            return $this->dataResponse('show slider', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function store(StoreSliderRequest $request)
    {
        try {
            $slider = $this->sliderService->store(dataRequest: $request->validated());
            return $this->dataResponse(__('message.success_create'),  new SliderResource($slider), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function update(UpdateSliderRequest $request, int $id)
    {
        try {
            $slider = $this->sliderService->update(dataRequest: $request->validated(), id: $id);
            return $this->dataResponse(__('message.success_update'),  new SliderResource($slider), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->sliderService->delete($id);
            $msg = __('message.success_delete');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
