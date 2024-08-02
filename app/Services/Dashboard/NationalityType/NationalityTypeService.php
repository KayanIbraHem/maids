<?php

namespace App\Services\Dashboard\NationalityType;

use App\Bases\CrudOperation\CrudOperationBase;
use App\Models\NationalityType\NationalityType;

class NationalityTypeService extends CrudOperationBase
{
    protected string $model = 'App\\Models\\NationalityType\\NationalityType';
    protected bool $hasTranslatedColumns = false;
}
