<?php

namespace App\Services\ServiceType;

use App\Services\BaseCrudService;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ServiceTypeService extends BaseCrudService
{
    protected string $model = 'App\\Models\\ServiceType\\ServiceType';
}
