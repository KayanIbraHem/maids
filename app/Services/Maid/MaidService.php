<?php

namespace App\Services\Maid;

use App\Models\Maid\Maid;
use App\Bases\Crud\CrudBase;

class MaidService extends CrudBase
{
    protected string $model = 'App\\Models\\Maid\\Maid';

    public function store(array $data)
    {
        return Maid::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'age' => $data['age'],
            'phone' => $data['phone'],
            'image' => uploadImage($data, 'image', 'maids'),
            'cv' => uploadPdf($data, 'maids'),
            'nationality_id' => $data['nationality_id'],
            'service_type_id' => $data['service_type_id'],
        ]);
    }
    public function update(array|object $data, int $id)
    {
        $row =  $this->getRowById($id);
        $row->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'age' => $data['age'],
            'phone' => $data['phone'],
            'image' => updateImage($data, $row, 'maids'),
            'cv' => updatePdf($data, $row, 'maids'),
            'nationality_id' => $data['nationality_id'],
            'service_type_id' => $data['service_type_id'],
        ]);
        return $row;
    }
    public function delete(int $id)
    {
        $row =  $this->getRowById($id);
        if ($row->image) {
            deleteImage($row->image);
        }
        if ($row->cv) {
            deletePdf($row->cv);
        }
        return $row->delete();
    }
}
