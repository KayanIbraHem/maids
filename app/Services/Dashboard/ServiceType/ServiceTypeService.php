<?php

namespace App\Services\Dashboard\ServiceType;

use App\Bases\CrudOperation\CrudOperationBase;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ServiceTypeService extends CrudOperationBase
{
    protected string $model = 'App\\Models\\ServiceType\\ServiceType';
    protected bool $hasTranslatedColumns = true;
    protected array $translatedColumns = ['title'];
}
