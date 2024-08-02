<?php

namespace App\Services\Dashboard\Admin;

use App\Models\Admin\Admin;
use App\Bases\CrudOperation\CrudOperationBase;

class AdminService extends CrudOperationBase
{
    protected string $model = 'App\\Models\\Admin\\Admin';
    protected string $imageKey = 'image';
    public function index()
    {
        return $this->model::NotSuperAdmin()->orderByDesc('id')->paginate(5);
    }
}
