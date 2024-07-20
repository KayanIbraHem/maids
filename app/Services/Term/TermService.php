<?php

namespace App\Services\Term;

use App\Bases\Crud\CrudBase;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class TermService extends CrudBase
{
    protected string $model = 'App\\Models\\Term\\Term';
    protected function prepareData(array $dataRequest): array
    {
        $data = [];
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $data[$localeCode] = [
                'title' => $dataRequest['title_' . $localeCode],
                'description' => $dataRequest['description_' . $localeCode],
            ];
        }
        return $data;
    }
}
