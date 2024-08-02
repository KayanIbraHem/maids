<?php

namespace App\Services\Dashboard\Policy;

use App\Bases\CrudOperation\CrudOperationBase;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PolicyService extends CrudOperationBase
{
    protected string $model = 'App\\Models\\Policy\\Policy';
    protected bool $hasTranslatedColumns = true;
    protected array $translatedColumns = ['description'];
}
