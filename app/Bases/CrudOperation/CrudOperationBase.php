<?php

namespace App\Bases\CrudOperation;

use Illuminate\Database\Eloquent\Model;

class CrudOperationBase extends CrudOperationHandler
{

    public function index()
    {
        return $this->paginate();
    }
    public function show(int $id)
    {
        return  $this->getRowById($id);
    }
    public function store(array $dataRequest): Model
    {
        $data = $this->dataHandle($dataRequest);
        return  $this->model::create($data);
    }
    public function update(array|object $dataRequest, int $id): Model
    {
        $row =  $this->getRowById($id);
        $data = $this->dataHandle($dataRequest, $row);
        $row->update($data);

        return $row;
    }
    public function delete(int $id): bool
    {
        $row = $this->getRowById($id);
        $this->removeImage($row);
        $this->removeFile($row);

        return $row->delete();
    }
    protected function getRowById(int $id)
    {
        $row = $this->model::whereId($id)->first();
        if (!$row) {
            throw new \Exception(__('message.not_found'));
        }

        return $row;
    }
}
