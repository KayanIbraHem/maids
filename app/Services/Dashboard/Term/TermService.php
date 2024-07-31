<?php

namespace App\Services\Dashboard\Term;

use App\Bases\Crud\CrudBase;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class TermService extends CrudBase
{
    protected string $model = 'App\\Models\\Term\\Term';
    protected bool $hasTranslatedColumns = true;
    protected array $translatedColumns = ['title', 'description'];
}
