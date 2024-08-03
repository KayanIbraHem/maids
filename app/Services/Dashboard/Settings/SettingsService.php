<?php

namespace App\Services\Dashboard\Settings;

use Illuminate\Database\Eloquent\Model;
use App\Bases\CrudOperation\CrudOperationBase;


class SettingsService extends CrudOperationBase
{
    protected string $model = 'App\\Models\\Settings\\Settings';
    public function store(array $dataRequest): Model
    {
        $firstRow = $this->model::first();
        $firstRowId = $firstRow ? $firstRow->id : null;
        $data = $this->dataHandle($dataRequest);
        if ($firstRowId) {
            $model = $this->model::updateOrCreate(
                [
                    'id' => $firstRowId
                ],
                $data
            );
        } else {
            $model = $this->model::create($data);
        }
        return $model;
    }
}
