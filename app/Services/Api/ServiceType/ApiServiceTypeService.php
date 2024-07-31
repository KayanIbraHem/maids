<?php

namespace App\Services\Api\ServiceType;

use App\Bases\Fetch\FetchBase;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ApiServiceTypeService extends FetchBase
{
    protected string $model = 'App\\Models\\ServiceType\\ServiceType';
}
