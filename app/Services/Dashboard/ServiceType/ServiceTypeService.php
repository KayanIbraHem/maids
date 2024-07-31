<?php

namespace App\Services\Dashboard\ServiceType;

use App\Bases\Crud\CrudBase;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ServiceTypeService extends CrudBase
{
    protected string $model = 'App\\Models\\ServiceType\\ServiceType';
    protected bool $hasTranslatedColumns = true;
    protected array $translatedColumns = ['title'];
}
