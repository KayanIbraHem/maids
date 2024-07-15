<?php

namespace App\Http\Services\NationalityType;

use App\Http\Services\BaseCrudService;
use App\Models\NationalityType\NationalityType;

class NationalityTypeService extends BaseCrudService
{
    protected string $model = 'App\\Models\\NationalityType\\NationalityType';

    // public function getNationalityTypes()
    // {
    //     return NationalityType::paginate(5);
    // }
    // public function showNationalityType(int $id): NationalityType
    // {
    //     return  $this->findRow($id);
    // }
    public function store(array $dataRequest)
    {
        return NationalityType::create($dataRequest);
    }
    public function update(array $dataRequest, int $id)
    {
        $row =  $this->findRow($id);
        $row->update($dataRequest);
        return $row;
    }
    // public function deleteNationalityType($id): bool
    // {
    //     $nationalityType =  NationalityType::whereId($id)->first();
    //     if (!$nationalityType) {
    //         throw new \Exception('not_found');
    //     }
    //     return $nationalityType->delete();
    // }
    // private function findRow(int $id)
    // {
    //     $row = NationalityType::whereId($id)->first();
    //     if (!$row) {
    //         throw new \Exception('not_found.');
    //     }
    //     return $row;
    // }
}
