<?php

namespace App\Services\Dashboard\Policy;

use App\Bases\Crud\CrudBase;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PolicyService extends CrudBase
{
    protected string $model = 'App\\Models\\Policy\\Policy';
    protected bool $hasTranslatedColumns = true;
    protected array $translatedColumns = ['description'];
}
