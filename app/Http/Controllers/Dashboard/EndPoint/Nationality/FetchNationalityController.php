<?php

namespace App\Http\Controllers\Dashboard\EndPoint\Nationality;

use App\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Nationality\NationalityResource;
use App\Services\Dashboard\EndPoint\Nationality\FetchNationalityService;

class FetchNationalityController extends Controller
{
    use ApiResponse;

    public function __construct(private FetchNationalityService $fetchNationalityService)
    {
    }
    public function __invoke()
    {
        try {
            $nationalities = $this->fetchNationalityService->fetchNationalities();
            $response = NationalityResource::collection($nationalities);
            return $this->dataResponse('fetch all nationalities', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
