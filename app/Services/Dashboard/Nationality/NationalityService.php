<?php

namespace App\Services\Dashboard\Nationality;

use App\Bases\CrudOperation\CrudOperationBase;

class NationalityService extends CrudOperationBase
{
    protected string $model = 'App\\Models\\Nationality\\Nationality';
    protected string $imageKey = 'flag';
    protected bool $hasTranslatedColumns = true;
    protected array $translatedColumns = ['title'];
}
