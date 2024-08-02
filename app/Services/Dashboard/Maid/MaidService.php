<?php

namespace App\Services\Dashboard\Maid;

use App\Models\Maid\Maid;
use App\Bases\CrudOperation\CrudOperationBase;

class MaidService extends CrudOperationBase
{
    protected string $model = 'App\\Models\\Maid\\Maid';
    protected string $imageKey = 'image';
    protected string $fileKey = 'cv';
}
