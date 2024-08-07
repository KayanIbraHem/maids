<?php

namespace App\Bases\CrudOperation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

abstract class CrudOperationHandler
{
    protected string $model;
    protected string $imageKey = "";
    protected string $fileKey = "";
    protected bool $hasTranslatedColumns = false;
    protected bool $hasPaginate = true;
    protected array $translatedColumns = [];

    public function setTranslatedColumns(array $columns): void
    {
        $this->translatedColumns = $columns;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function setHasTranslatedColumns(bool $hasTranslatedColumns): void
    {
        $this->hasTranslatedColumns = $hasTranslatedColumns;
    }

    public function setHasPaginate(bool $hasPaginate): void
    {
        $this->hasPaginate = $hasPaginate;
    }

    abstract protected function store(array $data): Model;

    abstract protected function update(array|object $data, int $id): Model;

    abstract protected function delete(int $id): bool;

    protected function dataHandle(array $dataRequest): array
    {
        $data = $this->prepareColumns($dataRequest);
        $image = $this->prepareImage($dataRequest);
        $file = $this->prepareFile($dataRequest);
        if ($image) $data[$this->imageKey] = $image;
        if ($file) $data[$this->fileKey] = $file;
        return $data;
    }
    protected function prepareColumns(array $data): array
    {
        if ($this->hasTranslatedColumns) {
            $nonTranslatedData = array_diff_key($data, array_flip($this->getTranslatedColumnKeys()));
            $translatedData = $this->prepareData($data);
            return array_merge($nonTranslatedData, $translatedData);
        }

        return $data;
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
    private function getTranslatedColumnKeys(): array
    {
        $keys = [];
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            foreach ($this->translatedColumns as $column) {
                $keys[] = $column . '_' . $localeCode;
            }
        }

        return $keys;
    }
    protected function preparePaginate(): LengthAwarePaginator|Collection
    {
        $model = reflectionClass($this->model);
        if (method_exists($model, 'scopeSearch')) {
            $model = $model->search();
        }
        return $this->hasPaginate
            ? $model->orderByDesc('id')->paginate(5)
            : $this->model::get();
        // return $this->hasPaginate
        //     ? $this->model::filter()->orderByDesc('id')->paginate(5)
        //     : $this->model::get();
    }
    protected function prepareImage(array $data): ?string
    {
        return  array_key_exists($this->imageKey, $data)
            ? uploadImage($data, $this->imageKey, strtolower(class_basename($this->model)))
            : null;
    }
    protected function prepareFile(array $data): ?string
    {
        return  array_key_exists($this->fileKey, $data)
            ? uploadImage($data, $this->fileKey, strtolower(class_basename($this->model)))
            : null;
    }
    protected function removeImage($row): void
    {
        $image = $this->checkImage($row);
        if ($image) deleteImage($image);
    }
    protected function removeFile($row): void
    {
        $file = $this->checkFile($row);
        if ($file) deletePdf($file);
    }
    private function checkImage($row): ?string
    {
        return isset($row[$this->imageKey]) ? $row[$this->imageKey] : null;
    }
    private function checkFile($row): ?string
    {
        return isset($row[$this->fileKey]) ? $row[$this->fileKey] : null;
    }
}
