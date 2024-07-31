<?php

namespace App\Services\Dashboard\EndPoint\ServiceType;

use App\Bases\Crud\CrudBase;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class FetchServiceTypeService extends CrudBase
{
    protected string $model = 'App\\Models\\ServiceType\\ServiceType';
    protected bool $hasPaginate = false;
}
