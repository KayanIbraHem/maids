<?php

namespace App\Http\Services\ServiceType;

use App\Http\Services\BaseCrudService;
use App\Models\ServiceType\ServiceType;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ServiceTypeService extends BaseCrudService
{
    protected string $model = 'App\\Models\\ServiceType\\ServiceType';
}
