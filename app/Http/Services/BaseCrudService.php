<?php

namespace App\Http\Services;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class BaseCrudService
{
    protected string $model;
    public function index()
    {
        return $this->model::paginate(5);
    }
    public function show(int $id)
    {
        return  $this->findRow($id);
    }
    public function store(array $data)
    {
        $data = $this->prepareData($data);
        return $this->model::create($data);
    }
    public function update(array $data, int $id)
    {
        $row =  $this->findRow($id);
        $data = $this->prepareData($data);
        $row->update($data);
        return $row;
    }
    public function delete(int $id)
    {
        $row =  $this->findRow($id);
        return $row->delete();
    }
    protected function findRow(int $id)
    {
        $row = $this->model::whereId($id)->first();
        if (!$row) {
            throw new \Exception('not_found.');
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
