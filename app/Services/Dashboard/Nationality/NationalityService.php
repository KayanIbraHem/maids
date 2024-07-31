<?php

namespace App\Services\Dashboard\Nationality;

use App\Bases\Crud\CrudBase;

class NationalityService extends CrudBase
{
    protected string $model = 'App\\Models\\Nationality\\Nationality';
    protected bool $hasTranslatedColumns = true;
    protected array $translatedColumns = ['title'];
}
