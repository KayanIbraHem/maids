<?php

namespace App\Services\NationalityType;

use App\Services\BaseCrudService;
use App\Models\NationalityType\NationalityType;

class NationalityTypeService extends BaseCrudService
{
    protected string $model = 'App\\Models\\NationalityType\\NationalityType';
    public function store(array $dataRequest)
    {
        return NationalityType::create($dataRequest);
    }
    public function update(array|object $dataRequest, int $id)
    {
        $row =  $this->findRow($id);
        $row->update($dataRequest);
        return $row;
    }
}
