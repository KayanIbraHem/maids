<?php

namespace App\Bases\Crud;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CrudBase
{
    protected string $model;
    public function index()
    {
        return $this->model::orderBy('id', 'desc')->paginate(5);
    }
    public function show(int $id)
    {
        return  $this->getRowById($id);
    }
    public function store(array $data)
    {
        $data = $this->prepareData($data);
        return $this->model::create($data);
    }
    public function update(array|object $data, int $id)
    {
        $row =  $this->getRowById($id);
        $data = $this->prepareData($data);
        $row->update($data);
        return $row;
    }
    public function delete(int $id)
    {
        $row =  $this->getRowById($id);
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
    protected function prepareData(array $dataRequest): array
    {
        $data = [];
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = [
                'title' => $dataRequest['title_' . $localeCode],
            ];
        }
        return $data;
    }
}
