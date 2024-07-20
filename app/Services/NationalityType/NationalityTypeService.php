<?php

namespace App\Services\NationalityType;

use App\Bases\Crud\CrudBase;
use App\Models\NationalityType\NationalityType;

class NationalityTypeService extends CrudBase
{
    protected string $model = 'App\\Models\\NationalityType\\NationalityType';
    public function store(array $dataRequest)
    {
        return NationalityType::create($dataRequest);
    }
    public function update(array|object $dataRequest, int $id)
    {
        $row =  $this->getRowById($id);
        $row->update($dataRequest);
        return $row;
    }
}
