<?php

namespace App\Bases\Crud;

use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CrudBase
{
    protected string $model;
    protected string $imageKey;
    protected string $fileKey;
    protected bool $hasTranslatedColumns = false;
    protected bool $hasPaginate = true;
    protected array $translatedColumns = [];
    public function index()
    {
        return $this->preparePaginate();
    }
    public function show(int $id)
    {
        return  $this->getRowById($id);
    }
    public function store(array $dataRequest): Model
    {
        $data = $this->prepareColumns($dataRequest);
        $image = $this->prepareImage($dataRequest);
        if (!empty($image)) {
            $finalData = array_merge($data, ['image' => $image]);
        } else {
            $finalData = $data;
        }

        return  $this->model::create($finalData);
    }
    public function update(array|object $dataRequest, int $id)
    {
        $row =  $this->getRowById($id);
        $data = $this->prepareColumns($dataRequest);
        $image = $this->prepareImage($dataRequest);
        if (!empty($image)) {
            $finalData = array_merge($data, ['image' => $image]);
        } else {
            $finalData = $data;
        }
        $row->update($finalData);

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
    protected function prepareColumns(array $data): array
    {
        if ($this->hasTranslatedColumns) {
            return $this->prepareData($data);
        }

        return $data;
    }
    public function prepareImage(array $data)
    {
        if (array_key_exists('image', $data)) {
            return uploadImage($data, 'image', strtolower(class_basename($this->model)));
        }

        return null;
    }
    protected function prepareData(array $dataRequest): array
    {
        $data = [];
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            foreach ($this->translatedColumns as $column) {
                $data[$localeCode][$column] = $dataRequest[$column . '_' . $localeCode];
            }
        }

        return $data;
    }
    public function preparePaginate()
    {
        if ($this->hasPaginate) {
            return $this->model::orderByDesc('id')->paginate(5);
        }
        return $this->model::get();
    }
}
