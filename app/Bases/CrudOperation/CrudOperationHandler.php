<?php

namespace App\Bases\CrudOperation;

use App\Trait\FileHandle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

abstract class CrudOperationHandler
{
    use FileHandle;

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

    public function paginate(): LengthAwarePaginator|Collection
    {
        return $this->preparePaginate();
    }
    protected function dataHandle(array $dataRequest, ?Model $model = null): array
    {
        $data = $this->prepareColumns($dataRequest);
        $image = $this->prepareImage($dataRequest, $model);
        $file = $this->prepareFile($dataRequest, $model);
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
    private function preparePaginate(): LengthAwarePaginator|Collection
    {
        return $this->hasPaginate
            ? $this->applyScopeSearch($this->model)->orderByDesc('id')->paginate(5)
            : $this->model::get();
    }
    private function applyScopeSearch($model)
    {
        $model = reflectionClass($model);
        if (method_exists($model, 'scopeSearch')) {
            $model = $model->search();
        }

        return $model;
    }
}
