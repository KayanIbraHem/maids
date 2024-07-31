<?php

namespace App\Services\Dashboard\NationalityType;

use App\Bases\Crud\CrudBase;
use App\Models\NationalityType\NationalityType;

class NationalityTypeService extends CrudBase
{
    protected string $model = 'App\\Models\\NationalityType\\NationalityType';
    protected bool $hasTranslatedColumns = false;
}
