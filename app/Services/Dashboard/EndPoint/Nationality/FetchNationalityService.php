<?php

namespace App\Services\Dashboard\EndPoint\Nationality;

use App\Bases\CrudOperation\CrudOperationBase;

class FetchNationalityService
{

    public function __construct(protected CrudOperationBase $crudOperationBase)
    {
        $this->crudOperationBase->setModel('App\\Models\\Nationality\\Nationality');
        $this->crudOperationBase->setHasPaginate(false);
    }
    public function fetchNationalities()
    {
        return $this->crudOperationBase->index();
    }
}
