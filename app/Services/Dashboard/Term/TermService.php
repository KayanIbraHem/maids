<?php

namespace App\Services\Dashboard\Term;

use App\Bases\CrudOperation\CrudOperationBase;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class TermService extends CrudOperationBase
{
    protected string $model = 'App\\Models\\Term\\Term';
    protected bool $hasTranslatedColumns = true;
    protected array $translatedColumns = ['title', 'description'];
}
