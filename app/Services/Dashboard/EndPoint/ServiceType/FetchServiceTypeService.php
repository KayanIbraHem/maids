<?php

namespace App\Services\Dashboard\EndPoint\ServiceType;

use App\Bases\CrudOperation\CrudOperationBase;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class FetchServiceTypeService
{
    public function __construct(protected CrudOperationBase $crudOperationBase)
    {
        $this->crudOperationBase->setModel('App\\Models\\ServiceType\\ServiceType');
        $this->crudOperationBase->setHasPaginate(false);
    }
    public function fetchServiceTypes()
    {
        return $this->crudOperationBase->index();
    }
}
