<?php

namespace App\Services\Dashboard\EndPoint\Nationality;

use App\Bases\Crud\CrudBase;

class FetchNationalityService extends CrudBase
{
    protected string $model = 'App\\Models\\Nationality\\Nationality';
    protected bool $hasPaginate = false;
}
