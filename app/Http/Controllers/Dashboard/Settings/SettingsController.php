<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\Term\Term;
use App\Trait\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\Settings\SettingsService;
use App\Http\Requests\Dashboard\Settings\SettingsRequest;
use App\Http\Resources\Dashboard\Settings\SettingsResource;
use App\Http\Resources\Dashboard\Settings\ShowSettingsResource;

class SettingsController extends Controller
{
    use ApiResponse;
    public function __construct(private SettingsService $settingsService)
    {
    }
    public function index()
    {
        try {
            $settings = $this->settingsService->index();
            $response = SettingsResource::collection($settings)->response()->getData(true);
            return $this->dataResponse('fetch all settings', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function show(int $id)
    {
        try {
            $row = $this->settingsService->show($id);
            $response = new SettingsResource($row);
            return $this->dataResponse('show settings', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function store(SettingsRequest $request)
    {
        try {
            $settings = $this->settingsService->store(dataRequest: $request->validated());
            return $this->dataResponse(__('message.success_create'),  new SettingsResource($settings), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->settingsService->delete($id);
            $msg = __('message.success_delete');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
